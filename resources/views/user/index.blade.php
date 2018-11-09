@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Users</li>
      </ol>
    </nav>

    @include('partials._messages')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1> Users </h1>
            <a href="{{ route('user.create') }}"><button class="btn btn-primary">Create User</button></a>
            <a href="{{ route('student.create') }}"><button class="btn btn-primary">Bulk Create Users</button></a>
            @foreach ($users as $role_name => $role_users)
              <div class="card mt-5">
                  <div class="card-header">{{ $role_name }} ({{ $role_users->count() }})</div>
                  <div class="card-body">
                    <table class="table table-sm">
                      <tr>
                        <th>Student Identifier</th>
                        <th>First Name</th>
                        <th>Surname</th>
                        <th>Actions</th>
                      </tr>
                      @foreach($role_users as $user)
                      <tr>
                        <td><a href="{{ route('user.show', $user->id)}}">{{ $user->identifier }}</a></td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->surname }}</td>
                        <td></td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
