@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(auth()->user()->hasRole('marker') || auth()->user()->hasRole('lecturer') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('overseer'))
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                  <h1>Lab Class Tracker - Home</h1>
                  <p>Welcome to the Lab Class Tracker. Here you can view your lab class progress and marks.</p>
                  <a href="{{ route('lab.index') }}"><button class="btn btn-primary">Marker System</button></a>

                  @can('create labs')
                    <h1>Manage Labs</h1>
                    @foreach($labs as $lab)
                      @if(auth()->user()->can('marker ' . $lab->course_code) || auth()->user()->can('view labs'))
                        <a href="{{ route('lab.modify', $lab->id) }}"><button class="btn btn-primary">{{ $lab->course_code }}</button></a>
                      @endif
                    @endforeach
                    <a href="{{ route('lab.create') }}"><button class="btn btn-success">Create New Lab</button></a>
                  @endcan

                  @can('admin')
                    <h1>Admin</h1>
                      <a href="{{ route('user.index') }}"><button class="btn btn-primary">Users</button></a>
                  @endcan
                </div>
            </div>
            @endif

            @if(auth()->user()->enrolledLabs()->count() > 0)
              @foreach($studentLabs as $studentLab)
                <div class="card">
                  <div class="card-header">{{ $studentLab["lab"]->course_code }}</div>
                  <div class="card-body">
                    <table class="table">
                      <tr>
                        <th>Task Name</th>
                        <th>Marks</th>
                        <th>Action</th>
                      </tr>
                      @foreach($studentLab["tasks"] as $key => $task)
                      <tr>
                        <td>{{ $task->name }}</td>
                        <td></td>
                        <td>
                          @if($studentLab["progress"]->get($key)->status == 0)
                            <button class="btn btn-danger">Not Signed Off</button>
                          @else
                            <button class="btn btn-success">Signed Off</button>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              @endforeach
            @else
              <h2> Not enrolled in any Labs </h2>
            @endif
        </div>
    </div>
</div>
@endsection
