@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Your Lab's</div>

                <div class="card-body">
                  @foreach($labs as $lab)
                    @if(auth()->user()->can('marker ' . $lab->course_code) || auth()->user()->can('view labs'))
                      <a href="{{ route('lab.show', ['id' => $lab->id ]) }}">
                        <button class="btn btn-info">{{ $lab->course_code }}</button>
                      </a>
                    @endcan
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
