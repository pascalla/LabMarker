@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
              <div class="card mt-5">
                  <div class="card-header">{{ $user->firstname }}'s Profile</div>
                  <div class="card-body">
                    <p>Roles:</p>
                      <ul>
                        @foreach($user->getRoleNames() as $role)
                          <li>{{ $role}}</li>
                        @endforeach
                      </ul>
                    <p>Permissions:</p>
                    <ul>
                      @foreach ($user->getAllPermissions() as $permission)
                        <li>{{ $permission->name }}
                      @endforeach
                    </ul>
                  </div>
              </div>
              <div class="card mt-5">
                  <div class="card-header">{{ $user->firstname }}'s Profile</div>
                  <div class="card-body">
                    <p>Enrolled Labs:</p>
                    <ul>
                      @foreach($user->enrolledLabs()->get() as $lab)
                        <li>{{ $lab->course_code }}</li>
                      @endforeach
                    </ul>
                  </div>
              </div>
        </div>
    </div>
</div>
@endsection
