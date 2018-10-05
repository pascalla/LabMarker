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
                        <th>Options</th>
                      </tr>
                      @foreach($role_users as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
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
