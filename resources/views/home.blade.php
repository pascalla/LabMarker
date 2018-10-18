@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(!auth()->user()->hasRole('student'))
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
        </div>
    </div>
</div>
@endsection
