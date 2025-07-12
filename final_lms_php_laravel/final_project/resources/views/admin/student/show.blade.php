@extends('admin.layout.app')

@section('content')
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h5 class="mb-0">Student Details</h5>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">

                            <div class="d-flex flex-column align-items-center mb-3">
                                <img @if ($student->user->image == null) src="https://imgs.search.brave.com/gZ3W9GjnWyv8g9cDfw1qrVag80rOPbBgaMDkSRu3z40/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/dmVjdG9yc3RvY2su/Y29tL2kvcHJldmll/dy0xeC8wOC82MS9w/ZXJzb24tZ3JheS1w/aG90by1wbGFjZWhv/bGRlci1saXR0bGUt/Ym95LXZlY3Rvci0y/MzE5MDg2MS5qcGc"
            @else
                src="{{ asset('upload/' . $student->user->image) }}" @endif
                                    class="rounded-circle shadow mb-2" alt="Profile Image"
                                    style="width: 150px; height: 150px; object-fit: cover;">

                                <h4 class="mb-1 text-center">{{ $student->user->name }}</h4>
                                <small class="text-muted text-center">{{ $student->group->name }}</small>
                            </div>

                            <div class="text-start">
                                <div class="mb-3">
                                    <i class="bi bi-person-fill me-2 text-dark"></i>
                                    <strong>Name:</strong> {{ $student->user->name }}
                                </div>

                                <div class="mb-3">
                                    <i class="bi bi-envelope me-2 text-primary"></i>
                                    <strong>Email:</strong> {{ $student->user->email }}
                                </div>

                                <div class="mb-3">
                                    <i class="bi bi-building me-2 text-success"></i>
                                    <strong>College:</strong> {{ $student->college }}
                                </div>

                                <div class="mb-3">
                                    <i class="bi bi-award me-2 text-info"></i>
                                    <strong>Degree:</strong> {{ $student->degree }}
                                </div>

                                <div class="mb-3">
                                    <i class="bi bi-people-fill me-2 text-secondary"></i>
                                    <strong>Group:</strong> {{ $student->group->name }}
                                </div>

                                <div class="mb-3">
                                    <i class="bi bi-layers-fill me-2 text-warning"></i>
                                    <strong>Round:</strong> {{ $student->group->round->titel }}
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('student.index') }}" class="btn btn-outline-secondary w-100">
                                        <i class="bi bi-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div> <!-- end text-start -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
    </section>
@endsection
