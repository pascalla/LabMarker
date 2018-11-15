@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/foundation-icons.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.modify', $lab->id) }}">{{ $lab->course_code }}</a></li>
      <li class="breadcrumb-item active">Student Progress</li>
    </ol>
  </nav>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2>{{ $lab->course_code }} Student Progress</h2>
      <a href="{{ route('taskprogress.download', $lab->id) }}"><button class="btn btn-success mt-2">Export to CSV</button></a>
      <table class="table table-striped mt-5">
        <tr>
          <th>Name</th>
          @foreach($tasks as $task)
            <th>{{ $task->name }}</th>
          @endforeach
          <th>Total Marks</th>
          <th>Total Marks %</th>
        </tr>
          @foreach($studentProgress as $student)
        <tr>
          <td>{{ $student["student"]->getDropDownName() }}</td>
          @foreach($student["progress"] as $progress)
            <td><i class="{{ $progress->getProgressIcon() }}"></i></td>
          @endforeach
          <td>{{ $student["marks"] }}/{{ $totalMarks }}</td>
          <td>{{ ($student["marks"]/$totalMarks)*100 }}% </td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection
