@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Task</div>

                <div class="card-body">
                  {{ Form::open(['route' => ['task.update', $lab->id, $task->id]]) }}
                    <div class="form-group">
                      {{ Form::label('name', 'Name:')}}
                      {{ Form::text('name', $task->name, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('marks', 'Marks:')}}
                      {{ Form::text('marks', $task->marks, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::checkbox('full', 'value', false) }}
                      {{ Form::label('full', 'Full Marks Deadline Enabled:', array('class' => 'form-check-label')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('expiry_date', 'Expiry Date:')}}
                      {{ Form::text('expiry_date', old('expiry_date'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::checkbox('half', 'value', false) }}
                      {{ Form::label('half', 'Half Marks Deadline Enabled:', array('class' => 'form-check-label')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::label('half_expiry_date', 'Half Expiry Date:')}}
                      {{ Form::text('half_expiry_date', old('half_expiry_date'), array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                      {{ Form::hidden('task_id', $task->id) }}
                      {{ Form::hidden('lab', $lab->id) }}
                      {{ Form::submit('Update', array('class' => 'btn  btn-primary btn-block'))}}
                    </div>
                  {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
