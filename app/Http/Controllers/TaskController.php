<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Paginate the authenticated user's tasks.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // paginate the authorized user's tasks with 5 per page
        $sortBy = $request->sortBy ?? 'created_at';
        $sort = $request->sort ?? 'desc';
        $tasks = Auth::user()
            ->tasks()
            ->title($request)
            ->orderBy($sortBy, $sort)
            ->paginate(5);
        $tasks->appends($request->query());

        return view('tasks', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Store a new incomplete task for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate the given request
        $data = $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);

        // create a new incomplete task with the given title
        Auth::user()->tasks()->create([
            'title' => $data['title'],
            'is_complete' => false,
        ]);

        // flash a success message to the session
        session()->flash('status', 'Task Created!');

        // redirect to tasks index
        return redirect('/tasks');
    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Task $task)
    {
        // check if the authenticated user can complete the task
        $this->authorize('checkRole', $task);
        // mark the task as complete and save it
        $task->is_complete = true;
        $task->save();

        // flash a success message to the session
        session()->flash('status', 'Task Completed!');

        // redirect to tasks index
        return redirect('/tasks');
    }

    /**
     * Delete task.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Task $task)
    {
        // check if the authenticated user can complete the task
        $this->authorize('checkRole', $task);
        $task->delete();

        // flash a success message to the session
        session()->flash('status', 'Task Deleted!');

        // redirect to tasks index
        return redirect('/tasks');
    }
}
