@extends('admin.layout.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section profile">
        <div class="row">
            {{-- الجزء الأيسر - الصورة --}}
            <div class="col-xl-4">
                <div class="card">

                    <form method="POST" action="{{ route('profile.change_image', Auth::user()->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body profile-card d-flex flex-column align-items-center">
                            {{-- صورة البروفايل --}}
                            <img
                                id="profilePreview"
                                src="{{ auth()->user()->image
                                    ? asset('upload/' . auth()->user()->image)
                                    : 'https://imgs.search.brave.com/gZ3W9GjnWyv8g9cDfw1qrVag80rOPbBgaMDkSRu3z40/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/dmVjdG9yc3RvY2su/Y29tL2kvcHJldmll/dy0xeC8wOC82MS9w/ZXJzb24tZ3JheS1w/aG90by1wbGFjZWhv/bGRlci1saXR0bGUt/Ym95LXZlY3Rvci0y/MzE5MDg2MS5qcGc' }}"
                                class="rounded-circle shadow mb-3"
                                alt="Admin Profile Image"
                                style="width: 150px; height: 150px; object-fit: cover;"
                            >


                            <label for="upload_image" class="btn btn-outline-primary btn-sm mb-3">
                                <i class="bi bi-upload me-1"></i> Upload New Image
                            </label>
                            <input type="file" accept="image/*" name="image" class="d-none" id="upload_image">

                            <div id="saveChangesContainer" class="text-center mt-2" style="display: none;">
                                <button type="submit" class="btn btn-success px-4 fw-semibold">
                                    💾 Save Changes
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="text-center pb-4">
                        <h2>{{ Auth::user()->name }}</h2>
                        <h5 class="text-muted">Web Designer</h5>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter me-2"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook me-2"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram me-2"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">
                                    Edit Profile
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">
                                    Change Password
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                <div class="p-4 bg-white shadow-sm rounded">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="p-4 bg-white shadow-sm rounded">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            const imageInput = document.getElementById('upload_image');
            const previewImg = document.getElementById('profilePreview');
            const saveBtnContainer = document.getElementById('saveChangesContainer');

            imageInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        saveBtnContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    saveBtnContainer.style.display = 'none';
                }
            });
        </script>

    </section>
</main>
@endsection
