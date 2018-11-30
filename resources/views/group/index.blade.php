@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('lab.show', $lab->id) }}">{{ $lab->course_code }}</a></li>
      <li class="breadcrumb-item active">Groups</li>
    </ol>
  </nav>

  @include('partials._messages')
  <div class="row justify-content-center">
      <div class="col-md-8 col-sm-12">
        <h1>{{ $lab->course_code }} Groups ({{ $groups->count()}})</h2>
        <p>
          Groups are collections of students. Markers can view entire groups of students for easy marking. Groups are optional and do not need to be used. Students can be members of multiple groups.
        </p>
        <a href="{{ route('group.create', $lab->id) }}"><button class="btn btn-primary">Create Group</button></a>
        <button class="btn btn-primary">Create Bulk Groups</button>
          @foreach($groups as $group)
            <h2>{{ $group->name }}</h2>
            <a href="{{ route('groupmember.create', [$lab->id, $group->id])}}"><button class="btn btn-tiny btn-success">Add Students</button></a>
            <a href="{{ route('group.edit', [$lab->id, $group->id]) }}"<button class="btn btn-tiny btn-primary">Edit Group</button></a>
            {{ Form::open(['url' => route('group.destroy', [$lab->id, $group->id]), 'method' => 'DELETE', 'class' => 'form-delete d-inline']) }}
              {{ Form::hidden('lab', $lab->id) }}
              {{ Form::submit('Delete Group', ['class' => 'd-inline btn btn-tiny btn-danger']) }}
            {{ Form::close() }}

            <table class="table table-sm mt-5">
              <tr>
                <th>Student Number</th>
                <th>Surname</th>
                <th>First Name</th>
                <th>Options</th>
              </tr>
              @foreach($group->getMembers()->get() as $student)
              <tr>
                <td>{{ $student->identifier }}</td>
                <td>{{ $student->surname }}</td>
                <td>{{ $student->firstname }}</td>
                <td>
                  {{ Form::open(['url' => route('groupmember.destroy', [$lab->id, $group->id, $student->id]), 'method' => 'DELETE', 'class' => 'form-delete d-inline']) }}
                    {{ Form::hidden('lab', $lab->id) }}
                    {{ Form::submit('Delete', ['class' => 'd-inline btn btn-danger btn-tiny']) }}
                  {{ Form::close() }}
                </td>
              </tr>
              @endforeach
            </table>
          @endforeach
      </div>
  </div>
</div>
@include('partials._delete', array('info'=> 'This will permanently delete the group. All members will be removed from the group.'))
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
