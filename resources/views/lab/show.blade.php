@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ $lab->course_code }}</li>
      </ol>
    </nav>

    @include('partials._messages')

    <div class="row justify-content-center">
        <div class="col-md-6 col-sm-12 p-4">
          <h1 class="mb-2">{{ $lab->course_code }}</<h1>
          <div class="row">
            <a href="{{ route('taskprogress.index', $lab->id) }}"><button class="btn btn-primary">Student Progress</button></a>
            <a href="{{ route('task.index', $lab->id) }}"><button class="btn btn-primary">Lab Tasks</button></a>
            <a href="{{ route('enrollment.index', $lab->id) }}"><button class="btn btn-primary">Enrollments</button></a>
            <a href="{{ route('marker.index', $lab->id) }}"><button class="btn btn-primary">Markers</button></a>
            <a href="{{ route('group.index', $lab->id) }}"><button class="btn btn-primary">Groups</button></a>
            <a href="{{ route('lab.edit', $lab->id) }}"><button class="btn btn-primary">Edit Lab</button></a>
          </div>
          <div class="row">
            {{ Form::open(['route' => ['enrollment.update', $lab->id], 'method' => 'PUT', 'class' => 'form-reset d-inline']) }}
              {{ Form::hidden('lab', $lab->id) }}
              {{ Form::submit('Reset Year', ['class' => 'd-inline btn btn-warning']) }}
            {{ Form::close() }}

            {{ Form::open(['route' => ['lab.destroy', $lab->id], 'method' => 'DELETE', 'class' => 'form-delete d-inline']) }}
              {{ Form::hidden('lab', $lab->id) }}
              {{ Form::submit('Delete Lab Class', ['class' => 'd-inline btn btn-danger']) }}
            {{ Form::close() }}
          </div>
        </div>
    </div>
</div>

@include('partials._reset', array('info' => 'This will reset the year. It will unenrol all students currently enrolled and all will no longer be able to be marked off.'))

@include('partials._delete', array('info' => 'This delete the lab permanently and all student/task data will be lost.'))


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

$('.form-reset').on('click', function(e){
    e.preventDefault();
    var form = $(this);
    $('#reset').modal({ backdrop: 'static', keyboard: false })
        .on('click', '#delete-btn', function(){
            form.submit();
        });
});
</script>
@endsection
