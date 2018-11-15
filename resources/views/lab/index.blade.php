@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Labs</li>
      </ol>
    </nav>

    @include('partials._messages')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Your Lab's</div>

                <div class="card-body">
                  @foreach($labs as $lab)
                    @if(auth()->user()->can('marker ' . $lab->course_code) || auth()->user()->can('view labs'))
                      <a href="{{ route('student.index', ['id' => $lab->id ]) }}">
                        <button class="btn btn-info">{{ $lab->course_code }}</button></a>
                    @endcan
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
