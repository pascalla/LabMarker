@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.show', $lab->id) }}">{{ $lab->course_code }}</a></li>
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
                @if(!$marker->can('lecturer ' . $lab->course_code))


                <tr>
                  <td>{{ $marker->identifier }}</td>
                  <td>{{ $marker->firstname }}</td>
                  <td>{{ $marker->surname }}</td>
                  <td>
                    {{ Form::open(['route' => ['marker.destroy', $lab->id, $marker->id], 'method' => 'DELETE', 'class' => 'form-delete d-inline']) }}
                      {{ Form::hidden('lab', $lab->id) }}
                      {{ Form::submit('Delete', ['class' => 'd-inline btn btn-danger']) }}
                    {{ Form::close() }}
                  </td>
                </tr>
                @endif
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
