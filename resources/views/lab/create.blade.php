@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active">Create Lab</li>
    </ol>
  </nav>

  @include('partials._messages')

  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Create Lab</div>

              <div class="card-body">
                {{ Form::open(array('route' => 'lab.store')) }}
                  <div class="form-group">
                  {{ Form::label('course_code', 'Course Code:')}}
                  {{ Form::text('course_code', old('course_code'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                  {{ Form::label('year', 'Year:')}}
                  {{ Form::text('year', old('year'), array('class' => 'form-control')) }}
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
