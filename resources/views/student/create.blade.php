@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
      <li class="breadcrumb-item active">Create Bulk Students</li>
    </ol>
  </nav>

  @include('partials._messages')

  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Create Bulk Students</div>

              <div class="card-body">
                <a href="{{ route('student.template') }}"><button class="btn btn-success mt-2 mb-5">Template</button></a>
                {{ Form::open(array('route' => 'student.store', 'files' => true)) }}
                  <div class="form-group">
                    {{ Form::label('students', 'Students File:') }}
                    {{ Form::file('students', null) }}
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
