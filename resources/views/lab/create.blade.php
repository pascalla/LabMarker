@extends('layouts.app')

@section('content')
<div class="container">
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
                      {{ Form::submit('Create', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
