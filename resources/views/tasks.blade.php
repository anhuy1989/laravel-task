@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card card-new-task">
                    <div class="card-header">
                        New Task
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" maxlength="255"
                                       class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="title">Tasks</span>
                        <form method="GET" action="{{ route('tasks.index') }}" class="text-right">
                            <input type="text" name="title" class="form-control" value="{{ Request::get('title') }}" placeholder="Search..."/>
                        </form>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <?php
                                    $sort = (Request::input('sort','desc')=='desc') ? 'asc' : 'desc';
                                    $query = '&sort='.$sort;
                                    if (Request::input('title')) {
                                        $query .='&title='.Request::input('title');
                                    }
                                ?>
                                <th scope="col">
                                    <a href="{{route('tasks.index')}}?sortBy=created_at{{$query}}">#</a>
                                </th>
                                <th scope="col">
                                    <a href="{{route('tasks.index')}}?sortBy=title{{$query}}">Title</a>
                                </th>
                                <th scope="col" class="text-right">Actions</th>
                            </tr>
                            </thead>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>
                                        @if ($task->is_complete)
                                            <s>{{ $task->title }}</s>
                                        @else
                                            {{ $task->title }}
                                        @endif
                                    </td>
                                    <td class="text-right d-flex flex-row-reverse">
                                        <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                        </form>
                                        @if (! $task->is_complete)
                                            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary">Complete</button>
                                            </form>
                                        @endif
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
