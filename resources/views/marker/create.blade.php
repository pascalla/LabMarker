@extends('layouts.app')

@section('style')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.modify', $lab->id) }}">{{ $lab->course_code }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('marker.index', $lab->id) }}">Markers</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Marker</li>
    </ol>
  </nav>

  @include('partials._messages')

  <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">{{ $lab->course_code }} - Select Markers to Add</div>
          <div class="card-body">
            {{ Form::open(array('url' => route('marker.store', $lab->id) )) }}
              <div class="form-group">
              {{ Form::label('students', 'Students:')}}
              {{ Form::select('students[]', $students, null, array('class' => 'form-control', 'multiple' => 'true', 'id' => 'students')) }}
              </div>
              <div class="form-group">
                {{ Form::hidden('lab', $lab->id) }}
                {{ Form::submit('Create', array('class' => 'btn  btn-primary btn-block'))}}
              </div>
            {{ Form::close() }}
              <p>You can use ';', ' ', or ',' to tokenize your selections.</p>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>

$("#students").select2({
	placeholder: "Select students",
	tokenSeparators: [';', ' ', ',']
});

</script>
@endsection
