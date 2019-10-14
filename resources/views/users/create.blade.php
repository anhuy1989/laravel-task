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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="title">Create New User</span>
                        <div class="text-right">
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input id="name" name="name" type="text" maxlength="255"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input id="email" name="email" type="text" maxlength="255"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input id="password" name="password" type="password" maxlength="255"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                <input id="confirm-password" name="confirm-password" type="password" maxlength="255"
                                       class="form-control{{ $errors->has('confirm-password') ? ' is-invalid' : '' }}"
                                       autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="roles[]" multiple class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role}}">{{$role}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
