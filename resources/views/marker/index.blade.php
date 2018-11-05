@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.modify', $lab->id) }}">{{ $lab->course_code }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Markers</li>
    </ol>
  </nav>

  @include('partials._messages')

  <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header">{{ $lab->course_code }} - Markers</div>
          <div class="card-body">
            <a href="{{ route('marker.create', $lab->id) }}"><button class="btn btn-success">Add Markers</button></a>
            <table class="table mt-2">
              <tr>
                <th>Student Number</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Options</th>
              </tr>
              @foreach($markers as $marker)
                <tr>
                  <td>{{ $marker->identifier }}</td>
                  <td>{{ $marker->firstname }}</td>
                  <td>{{ $marker->surname }}</td>
                  <td><button class="btn btn-danger">Remove</button>
                </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
