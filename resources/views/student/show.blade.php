@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <h1>{{ $student->name }} ({{ $student->student_number }})</h1>

          @foreach($studentData as $lab)
          @if(auth()->user()->can('marker ' . $lab["lab"]->course_code) || auth()->user()->can('view labs'))
            <div class="card mb-3">
                <div class="card-header">{{ $lab["lab"]->course_code }}</div>
                <div class="card-body">
                  <ul>
                  @foreach($lab["tasks"] as $task)
                    <li>{{ $task->name }}</li>
                  @endforeach
                  </ul>
                </div>
            </div>
          @endif
          @endforeach

        </div>
    </div>
</div>
@endsection
