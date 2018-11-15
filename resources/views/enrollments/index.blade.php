@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('lab.show', $lab->id) }}">{{ $lab->course_code }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">Enrollments</li>
      </ol>
    </nav>

    @include('partials._messages')

    <div class="row justify-content-center">
        <div class="col-md-6">
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
                    <td>
                      {{ Form::open(['route' => ['enrollment.destroy'], 'method' => 'DELETE', 'class' => 'form-delete']) }}
                        {{ Form::hidden('lab', $lab->id) }}
                        {{ Form::hidden('student', $student->id) }}
                        {{Form::submit('Disenroll', ['class' => 'btn btn-danger']) }}
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

@include('partials._delete')
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
