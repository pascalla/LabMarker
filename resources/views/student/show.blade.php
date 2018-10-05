@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <h1>{{ $student->name }} ({{ $student->student_number }})</h1>

          @foreach($labs as $lab)
          @if(auth()->user()->can('marker ' . $lab["lab"]->course_code) || auth()->user()->can('view labs'))
            <div class="card mb-3">
                <div class="card-header">{{ $lab["lab"]->course_code }}</div>
                <div class="card-body">
                  <table class="table table-striped">
                    <tr>
                      <th>Task Name</th>
                      <th>Options</th>
                    </tr>

                    @foreach($lab["tasks"] as $task)
                    <tr>
                      <td title='{{ $task["task"]->id }}'>{{ $task["task"]->name }}</td>
                      @if($task["status"] == 1)
                        <td>
                          <button class="btn btn-primary">Signed Off</button>
                        </td>
                      @else
                        <td>
                          @if(auth()->user()->can('marker ' . $lab["lab"]->course_code) || auth()->user()->can('admin'))
                            {{ Form::open(['route' => 'taskprogress.store']) }}
                              {{ Form::hidden('lab', $lab["lab"]->id) }}
                              {{ Form::hidden('student_id', $student->id) }}
                              {{ Form::hidden('task_id', $task["task"]->id) }}
                              {{Form::submit('Sign Off', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                          @else
                            <button class="btn btn-danger">Not Signed Off</button>
                          @endif
                        </td>
                      @endif
                    </tr>
                    @endforeach

                  </table>
                </div>
            </div>
          @endif
          @endforeach

        </div>
    </div>
</div>
@endsection
