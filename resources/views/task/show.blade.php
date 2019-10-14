@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card card-task-info">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="title">Task Info</span>
                        <div class="text-right">
                            <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{$task->name}}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Is Completed:</strong>
                                {{$task->is_completed ? 'Yes' : 'No'}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
