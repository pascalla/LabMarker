@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container-fluid">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.show', $lab->id) }}">{{ $lab->course_code }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lab Tasks</li>
    </ol>
  </nav>

  @include('partials._messages')

  <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">{{ $lab->course_code }} - Lab Tasks ({{ $tasks->count()}})</div>
          <div class="card-body">
            <a href="{{ route('task.create', $lab->id) }}"<button class="btn btn-success mb-3">Create Lab Task</button></a>
            <table class="table">
              <tr>
                <th>Lab Task Name</th>
                <th>Marks</th>
                <th>Full Mark Deadline</th>
                <th>Half Mark Deadline</th>
                <th>Action</th>
              </tr>
              @foreach($tasks as $task)
              <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->marks }}</td>
                <td>{{ $task->full_marks }}</td>
                <td>{{ $task->half_marks }}</td>
                <td>
                  <a href="{{ route('task.edit', [$task->lab_id, $task->id]) }}"><button class="d-inline btn btn-primary">Edit</button></a>
                  {{ Form::open(['route' => ['task.destroy', $lab->id, $task->id], 'method' => 'DELETE', 'class' => 'form-delete d-inline']) }}
                    {{ Form::hidden('lab', $task->lab_id) }}
                    {{ Form::submit('Delete', ['class' => 'd-inline btn btn-danger']) }}
                  {{ Form::close() }}
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
  </div>
</div>

@include('partials._delete', array('info' => 'This will delete the task permanently and all student\'s progress on this task will also be deleted.'))
@endsection

@section('scripts')
<script>
$('.form-delete').on('click', function(e){
    e.preventDefault();
    var form = $(this);
    $('#confirm').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            form.submit();
        });
});
</script>
@endsection
