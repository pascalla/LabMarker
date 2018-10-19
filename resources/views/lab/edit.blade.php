@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">Update {{ $lab->name }}</div>
            <div class="card-body">
              {{ Form::open(array('url' => route('lab.update', $lab->id) )) }}
                <div class="form-group">
                  {{ Form::label('course_code', 'Course Code:')}}
                  {{ Form::text('course_code', $lab->course_code, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                  {{ Form::label('year', 'Year:')}}
                  {{ Form::text('year', old('year'), array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                  {{ Form::submit('Update', array('class' => 'btn  btn-primary btn-block'))}}
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
