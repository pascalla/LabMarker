@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">{{ $lab->course_code }} - Enrollments ({{ $students->count() }})</div>
            <div class="card-body">
              <a href="{{ route('enrollments.create', $lab->id)}}"<button class="btn btn-success mb-3">Enrol Students</button></a>
              <table class="table">
                <tr>
                  <th>Student Number</th>
                  <th>Surname</th>
                  <th>First name</th>
                  <th>Action</th>
                </tr>
                @foreach($students as $student)
                  <tr>
                    <td>{{ $student->identifier }}</td>
                    <td>{{ $student->surname }}</td>
                    <td>{{ $student->firstname}}</td>
                    <td><button class="btn btn-danger">Disenroll</button></td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
