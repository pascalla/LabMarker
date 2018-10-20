@extends('layouts.app')

@section('content')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
      <li class="breadcrumb-item active">Create Users</li>
    </ol>
  </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
                  {{ Form::open(array('route' => 'user.store')) }}
                    <div class="form-group">
                      {{ Form::label('identifier', 'Identifier:') }}
                      {{ Form::text('identifier', old('identifier'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('firstname', 'First Name:') }}
                      {{ Form::text('firstname', old('firstname'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('surname', 'Surname') }}
                      {{ Form::text('surname', old('surname'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('role', 'Role:') }}
                      {{ Form::select('role', array('Student' => 'Student', 'Marker' => 'Marker', 'Lecturer' => 'Lecturer', 'Overseer' => 'Overseer', 'Admin' => 'Admin', 'System Admin' => 'System Administrator'),
                          old('role'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::submit('Create', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
