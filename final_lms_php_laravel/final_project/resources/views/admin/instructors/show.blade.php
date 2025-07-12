@extends('admin.layout.app')

@section('content')
    <section class="section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">instructor Details</h5>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 p-4 bg-light text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <img @if ($insructors->user->image == null) src="https://imgs.search.brave.com/gZ3W9GjnWyv8g9cDfw1qrVag80rOPbBgaMDkSRu3z40/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/dmVjdG9yc3RvY2su/Y29tL2kvcHJldmll/dy0xeC8wOC82MS9w/ZXJzb24tZ3JheS1w/aG90by1wbGFjZWhv/bGRlci1saXR0bGUt/Ym95LXZlY3Rvci0y/MzE5MDg2MS5qcGc"
                        @else
                            src="{{ asset('upload/' . $admin->user->image) }}" @endif
                            class="rounded-circle shadow mb-3" alt="Admin Profile Image"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <hr>

                    <div class="text-start px-4">
                        <div class="mb-3">
                            <i class="bi bi-person-fill me-2 text-dark"></i>
                            <strong>Name:</strong> {{ $insructors->user->name }}
                        </div>



                        <div class="mb-3">
                            <i class="bi bi-envelope me-2 text-primary"></i>
                            <strong>Email:</strong> {{ $insructors->user->email }}
                        </div>

                        <div class="mb-3">
                            <i class="bi bi-person-fill-up me-2 text-dark"></i>
                            <strong>Leader:</strong> {{ $insructors->user->type }}
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-person-badge-fill me-2 text-dark"></i>
                            <strong>track:</strong> {{ $insructors->track }}
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-person-badge-fill me-2 text-dark"></i>
                            <strong>department:</strong> {{ $insructors->departments->name }}
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('instructor.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
