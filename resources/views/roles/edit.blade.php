@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card card-edit-task">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="title">Edit Role</span>
                        <div class="text-right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="name" type="text" maxlength="255"
                                       value="{{$role->name}}"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>


                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <strong>Permission:</strong>
                                <br/>
                                @foreach($permission as $value)
                                    <div class="form-check">
                                        <input id="permission_{{$value->id}}" name="permission[{{$value->id}}]"
                                               type="checkbox"
                                               {{in_array($value->id, $rolePermissions) ? 'checked' : ''}}
                                               class="form-check-input"/>
                                        <label class="form-check-label"
                                               for="permission_{{$value->id}}">{{$value->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection
