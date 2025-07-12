@extends('admin.layout.app')

@section('content')

<form method="POST" action="{{ route('admin.update', $admin->id) }}" enctype="multipart/form-data">
    @csrf
 

    <div class="pagetitle">
        <h1>Admin Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Admins</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title mb-0">Edit Admin Details</h5>
            <a href="{{ route('admin.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Add New
            </a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card shadow border-0 p-4 text-center mb-4">
                    <div class="mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                        <img
                            @if ($admin->user->image == null)
                                src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                            @else
                                src="{{ asset('upload/' . $admin->user->image) }}"
                            @endif
                            class="rounded-circle shadow-sm mb-3"
                            alt="Admin Profile Image"
                            style="width: 130px; height: 130px; object-fit: cover; transition: 0.3s;">
                    </div>
                    </div>
                    <h5 class="fw-bold text-primary">{{ $admin->user->name }}</h5>
                    <p class="text-muted mb-1">{{ $admin->position }}</p>
                    <span class="badge bg-secondary text-uppercase">{{ $admin->user->type }}</span>
                </div>

                <div class="card shadow-sm p-4 bg-white">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input name="name" id="name" value="{{ $admin->user->name }}" type="text" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input name="email" id="email" value="{{ $admin->user->email }}" type="email" class="form-control">
                    </div>

                    <div class="form-group mb-4">
                        <label for="position" class="form-label fw-semibold">Position</label>
                        <input name="position" id="position" value="{{ $admin->position }}" type="text" class="form-control">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success px-5">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<style>img:hover {
    transform: scale(1.05);
}
</style>
@endsection
