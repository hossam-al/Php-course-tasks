@extends('admin.layout.app')

@section('content')
    <form method="POST" action="{{ route('instructor.update', $instructors->id) }}" enctype="multipart/form-data">
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
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="card shadow border-0 p-4 text-center mb-4">
                        <div class="mb-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <img @if ($instructors->user->image == null) src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                            @else
                                src="{{ asset('upload/' . $instructors->user->image) }}" @endif
                                    class="rounded-circle shadow-sm mb-3" alt="Admin Profile Image"
                                    style="width: 130px; height: 130px; object-fit: cover; transition: 0.3s;">
                            </div>
                        </div>
                        <h5 class="fw-bold text-primary">{{ $instructors->user->name }}</h5>
                        <p class="text-muted mb-1">{{ $instructors->departments->name }}</p>
                        <span class="badge bg-secondary text-uppercase">{{ $instructors->user->type }}</span>
                    </div>

                    <div class="card shadow-sm p-4 bg-white">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label fw-semibold">Name</label>
                            <input name="name" id="name" value="{{ $instructors->user->name }}" type="text"
                                class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input name="email" id="email" value="{{ $instructors->user->email }}" type="email"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">track</label>
                            <input type="text" class="form-control"  value="{{ $instructors->track }}" name="track" id="inputAddress">
                        </div>
                           <div class="col-12">
                            <label for="inputAddress" class="form-label">Linkedin</label>
                            <input type="text" class="form-control"  value="{{ $instructors->linkedin }}" name="linkedin" id="inputAddress">
                        </div>
                        <div class="form-group mb-4">
                            <label for="" class="form-label">department </label>
                            <select name="department" class="form-select">

                                @foreach ($department as $item)
                                    @if ($item['name'] == $instructors->departments->name)
                                        <option selected value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                    @else
                                        <option value="{{ $item['id'] }}"> {{ $item['name'] }} </option>
                                    @endif
                                @endforeach


                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <style>
        img:hover {
            transform: scale(1.05);
        }
    </style>
@endsection
