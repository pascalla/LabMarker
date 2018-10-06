@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($users as $role_name => $role_users)
              <div class="card mt-5">
                  <div class="card-header">{{ $role_name }}</div>
                  <div class="card-body">
                    <table class="table table-sm">
                      <tr>
                        <th>Name</th>
                        <th>Roles</th>
                      </tr>
                      @foreach($role_users as $user)
                      <tr>
                        <td><a href="{{ route('user.show', $user->id)}}">{{ $user->name }}</a></td>
                        <td>Options</td>
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
