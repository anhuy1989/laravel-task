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

                <div class="card card-edit-task">
                    <div class="card-header">
                        Edit Task
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.update',  $task) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" maxlength="255"
                                       value="{{$task->name}}"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>


                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-check">
                                <input id="is_complete" name="is_complete" type="checkbox"
                                       class="form-check-input" {{$task->is_complete ? 'checked' : ''}}/>
                                <label class="form-check-label" for="is_complete">Completed</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
