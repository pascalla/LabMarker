@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create User</div>

                <div class="card-body">
                  {{ Form::open(array('route' => 'user.store')) }}
                    <div class="form-group">
                      {{ Form::label('name', 'Name:') }}
                      {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('email', 'Email:') }}
                      {{ Form::text('email', old('email'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('role', 'Role:') }}
                      {{ Form::select('role', array('Marker' => 'Marker', 'Lecturer' => 'Lecturer', 'Overseer' => 'Overseer', 'Admin' => 'Admin', 'System Admin' => 'System Administrator'), 
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
