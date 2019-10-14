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
                        <span class="title">User Management</span>
                        <div class="text-right">
                            @can('user-create')
                                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-right">Action</th>
                            </tr>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="text-right d-flex flex-row justify-content-end">
                                        <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                                        @can('user-edit')
                                            <a class="btn btn-primary ml-2"
                                               href="{{ route('users.edit',$user->id) }}">Edit</a>
                                        @endcan
                                        @can('user-delete')
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>

            </div>
@endsection
