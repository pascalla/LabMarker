@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1>{{ $lab->course_code }}</h1>
            @if(auth()->user()->can('marker ' . $lab->course_code) || auth()->user()->can('view ' . $lab->course_code) || auth()->user()->can('view labs'))
            <div class="card mb-3">
                <div class="card-header">Search Students</div>
                <div class="card-body">
                  {{ Form::open(array('route' => 'task.store')) }}
                    <div class="form-group">
                    {{ Form::label('student_id', 'Student ID:')}}
                    {{ Form::text('student_id', old('student_id'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::submit('Search', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
            @endif
            @if(auth()->user()->can('lecturer ' . $lab->course_code) || auth()->user()->can('create lecturer'))
            <div class="card mb-3">
                <div class="card-header">Markers</div>
                <div class="card-body">
                  {{ Form::open(array('route' => 'marker.add')) }}
                    <div class="form-group">
                    {{ Form::label('marker_id', 'Add Marker:')}}
                    {{ Form::text('marker_id', old('marker_id'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::hidden('course_code', $lab->course_code) }}
                      {{ Form::hidden('lab', $lab->id) }}
                      {{ Form::submit('Add', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                  <h2> Markers </h2>
                  <ul>
                  @foreach ($markers as $marker)
                    <li>{{$marker->name}}</li>
                  @endforeach
                  </ul>
                </div>
            </div>
            @endif
            @if(auth()->user()->can('lecturer ' . $lab->course_code) || auth()->user()->can('create lecturer'))
            <div class="card mb-3">
                <div class="card-header">Tasks</div>
                <div class="card-body">
                  {{ Form::open(array('route' => 'task.store')) }}
                    <div class="form-group">
                    {{ Form::label('task_name', 'Add Task:')}}
                    {{ Form::text('task_name', old('task_name'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::hidden('lab', $lab->id) }}
                      {{ Form::submit('Add', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                  <h2> Tasks </h2>
                  <ul>
                  @foreach ($tasks as $task)
                    <li>{{$task->name}}</li>
                  @endforeach
                  </ul>
                </div>
            </div>
            @endif
            @if(auth()->user()->can('lecturer ' . $lab->course_code) || auth()->user()->can('create lecturer'))
            <div class="card mb-3">
                <div class="card-header">Students</div>
                <div class="card-body">
                  {{ Form::open(array('route' => 'enrollment.store')) }}
                    <div class="form-group">
                    {{ Form::label('student_id', 'Add Student:')}}
                    {{ Form::text('student_id', old('student_id'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::hidden('lab', $lab->id) }}
                      {{ Form::submit('Add Student', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                  <h2> Students </h2>
                  <ul>
                  @foreach ($students as $student)
                    <li>{{$student->name}}</li>
                  @endforeach
                  </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
