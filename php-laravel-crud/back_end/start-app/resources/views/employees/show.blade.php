@extends('layouts.app')

@section('content')
    <div class="container col-md-8 mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-warning d-flex justify-content-between align-items-center">
                <h5 class="mb-0">View Employee</h5>
                <a class="btn btn-warning btn-sm" href="{{ route('employee.index') }}">Back</a>
            </div>
            <div class="card-body bg-dark">
                @if ($employee->image != null)
                    <div class="text-center mb-4">
                        <img src="{{ asset('upload/' . $employee->image) }}" alt="Employee Image" class="img-thumbnail border-warning" style="max-width: 200px;">
                    </div>
                @else
                    <div class="text-center mb-4">
                        <img src="{{ asset('image.png') }}" alt="Default Image" class="img-thumbnail border-warning" style="max-width: 200px;">
                    </div>
                @endif

                <div class="mb-3">
                    <h4 class="text-warning">Name:</h4>
                    <p class="fs-5 text-light">{{ $employee->name }}</p>
                </div>
                <div class="mb-3">
                    <h4 class="text-warning">Salary:</h4>
                    <p class="fs-5 text-light">{{ $employee->salary }}</p>
                </div>
                <div class="mb-3">
                    <h4 class="text-warning">Department:</h4>
                    <p class="fs-5 text-light">{{ $employee->department->name }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
