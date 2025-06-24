@extends('layouts.app')

@section('content')
    <div class="container col-md-8 mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-warning d-flex justify-content-between align-items-center">
                <h5 class="mb-0">View department</h5>
                <a class="btn btn-warning btn-sm" href="{{ route('department.index') }}">Back</a>
            </div>
            <div class="card-body bg-dark">

                <div class="mb-3">
                    <h4 class="text-warning">Name:</h4>
                    <p class="fs-5 text-light">{{ $department->name }}</p>
                </div>
                <div class="mb-3">
                    <h4 class="text-warning">department:</h4>
                    <p class="fs-5 text-light">{{ $department->description }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection
