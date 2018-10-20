@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ $lab->course_code }}</li>
      </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">{{ $lab->course_code }}</div>
            <div class="card-body">
              <a href="{{ route('lab.progress', $lab->id) }}"><button class="btn btn-primary">Student Progress</button></a>
              <a href="{{ route('task.index', $lab->id) }}"><button class="btn btn-primary">Lab Tasks</button></a>
              <a href="{{ route('lab.enroll', $lab->id) }}"><button class="btn btn-primary">Enrollments</button></a>
              <a href="{{ route('lab.groups', $lab->id) }}"><button class="btn btn-primary">Groups</button></a>
              <a href="{{ route('lab.edit', $lab->id) }}"><button class="btn btn-primary">Edit Lab Class Name</button></a>
              <a href="#"><button class="btn btn-danger d-block mt-2">Delete Lab Class</button></a>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
