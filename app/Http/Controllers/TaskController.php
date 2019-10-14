<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index','show']]);
        $this->middleware('permission:task-create', ['only' => ['create','store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }

    /**
     * Paginate the authenticated user's tasks.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sortBy = $request->sortBy ?? 'created_at';
        $sort = $request->sort ?? 'desc';
        $tasks = Task::name($request)
            ->orderBy($sortBy, $sort)
            ->paginate(5);
        $tasks->appends($request->query());

        return view('task.index', [
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
            'name' => 'required|string|max:255',
        ]);

        // create a new incomplete task with the given name
        Task::create([
            'name' => $data['name'],
            'is_complete' => false,
        ]);

        // flash a success message to the session
        session()->flash('status', 'Task Created!');

        // redirect to tasks index
        return redirect('/tasks');
    }

    /**
     * Edit a task for the authenticated user.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Edit a task for the authenticated user.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Task $task)
    {
        return view('task.edit', compact('task'));
    }

    /**
     * Mark the given task as complete and redirect to tasks index.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Task $task)
    {
        // check if the authenticated user can complete the task
        // mark the task as complete and save it
        $data = $this->validate($request, [
            'name' => 'string|max:255'
        ]);
        $data['is_complete'] = $request->input('is_complete') ? 1 : 0;
        $task->update($data);
        // flash a success message to the session
        session()->flash('status', 'Task Updated!');

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
        $task->delete();

        // flash a success message to the session
        session()->flash('status', 'Task Deleted!');

        // redirect to tasks index
        return redirect('/tasks');
    }
}
