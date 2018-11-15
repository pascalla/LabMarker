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
            <a href="{{ route('lab.edit', $lab->id) }}"><button class="btn btn-primary">Edit Lab Class Name</button></a>
          </div>
          <div class="row">
            <a href="#"><button class="btn btn-danger">Delete Lab Class</button></a>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
