@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="title">Role Management</span>
                        <div class="text-right">
                            @can('role-create')
                                <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-right">Action</th>
                            </thead>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="d-flex flex-row justify-content-end">
                                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                                        @can('role-edit')
                                            <a class="btn btn-primary ml-2"
                                               href="{{ route('roles.edit',$role->id) }}">Edit</a>
                                        @endcan
                                        @can('role-delete')
                                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
