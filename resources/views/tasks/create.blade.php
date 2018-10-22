@extends('layouts.app')

@section('style')
  <link href="{{ asset('css/foundation-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/foundation-icons.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.modify', $lab->id) }}">{{ $lab->course_code }}</a></li>
      <li class="breadcrumb-item"><a href="{{ route('task.index', $lab->id) }}">Lab Tasks</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create Task</li>
    </ol>
  </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Task</div>

                <div class="card-body">
                  {{ Form::open(array('url' => route('task.store', $lab->id) )) }}
                    <div class="form-group">
                      {{ Form::label('name', 'Name:')}}
                      {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('marks', 'Marks:')}}
                      {{ Form::text('marks', old('marks'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::checkbox('full', 'true', false, array('id' => 'full')) }}
                      {{ Form::label('full', 'Full Marks Deadline Enabled:', array('class' => 'form-check-label')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('full_expiry_date', 'Expiry Date:')}}
                      {{ Form::text('full_expiry_date', old('expiry_date'), array('id' => 'full_marks_date', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::checkbox('half', 'true', false, array('id' => 'half')) }}
                      {{ Form::label('half', 'Half Marks Deadline Enabled:', array('class' => 'form-check-label')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('half_expiry_date', 'Half Expiry Date:')}}
                      {{ Form::text('half_expiry_date', old('half_expiry_date'), array('id' => 'half_marks_date', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::hidden('lab', $lab->id) }}
                      {{ Form::submit('Create', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/foundation-datepicker.min.js') }}"></script>
<script>
  $('#full_marks_date').fdatepicker({
    format: 'dd-mm-yyyy',
  });
  $('#half_marks_date').fdatepicker({
    format: 'dd-mm-yyyy'
  });

  $('#full').change(function() {
  	$('#full_marks_date').prop('disabled', function(i, v) { return !v; });
  });

  $('#half').change(function() {
  	$('#half_marks_date').prop('disabled', function(i, v) { return !v; });
  });
</script>
@endsection
