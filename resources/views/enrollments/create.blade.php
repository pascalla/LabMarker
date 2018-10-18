@extends('layouts.app')

@section('style')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">{{ $lab->course_code }} - Select Students to enrol</div>
            <div class="card-body">
              {{ Form::open(array('url' => route('enrollment.store', $lab->id) )) }}
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