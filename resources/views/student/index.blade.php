@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card mb-3">
              <div class="card-header">Add Students</div>
              <div class="card-body">
                {{ Form::open(array('route' => 'student.store')) }}
                  <div class="form-group">
                  {{ Form::label('student_number', 'Student ID:')}}
                  {{ Form::text('student_number', old('student_number'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                  {{ Form::label('student_name', 'Student Name:')}}
                  {{ Form::text('student_name', old('student_name'), array('class' => 'form-control')) }}
                  </div>
                  <div class="form-group">
                    {{ Form::submit('Search', array('class' => 'btn  btn-primary btn-block'))}}
                  </div>
                {{ Form::close() }}
              </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Current Students</div>
                  <h2> Students </h2>
                  <ul>
                  @foreach ($students as $student)
                    <a href="{{ route('student.show', ['id' => $student->id])}}"><li title="{{ $student->student_number }}">{{$student->name}}</li>
                  @endforeach
                  </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
