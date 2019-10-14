@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @can('task-create')
                    <div class="card card-new-task">
                        <div class="card-header">
                            New Task
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('tasks.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input id="name" name="name" type="text" maxlength="255"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           autocomplete="off"/>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                @endcan
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="title">Task Management</span>
                        <form method="GET" action="{{ route('tasks.index') }}" class="text-right">
                            <input type="text" name="name" class="form-control" value="{{ Request::get('name') }}"
                                   placeholder="Search..."/>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <?php
                                $sort = (Request::input('sort', 'desc') == 'desc') ? 'asc' : 'desc';
                                $query = '&sort=' . $sort;
                                if (Request::input('name')) {
                                    $query .= '&name=' . Request::input('name');
                                }
                                ?>
                                <th scope="col">
                                    <a href="{{route('tasks.index')}}?sortBy=created_at{{$query}}">#</a>
                                </th>
                                <th scope="col">
                                    <a href="{{route('tasks.index')}}?sortBy=name{{$query}}">Name</a>
                                </th>
                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>
                                        @if ($task->is_complete)
                                            <s>{{ $task->name }}</s>
                                        @else
                                            {{ $task->name }}
                                        @endif
                                    </td>
                                    <td class="text-right d-flex flex-row justify-content-end">
                                        @can('task-edit')
                                            @if(!$task->is_complete)
                                                <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                    <input type="hidden" name="is_complete" value="1">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary">Complete</button>
                                                </form>
                                            @endif
                                            <a href="{{route('tasks.edit', $task)}}" class="btn btn-info ml-2">Edit</a>
                                        @endcan
                                        @can('task-delete')
                                            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
