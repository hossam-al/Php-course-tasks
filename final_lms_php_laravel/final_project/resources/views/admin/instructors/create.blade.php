
@extends('admin.layout.app')


@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">List instructor
                            <a class="btn btn-info float-end" href="{{ route('instructor.index') }}">Back </a>
                        </h5>
                        {{-- User + admin --}}
                        <!-- Vertical Form -->
                        <form method="post" action="{{ route('instructor.store') }}" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">instructor Name</label>
                                <input type="text" name="name" class="form-control" id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail4">
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">track</label>
                                <input type="text" class="form-control" name="track" id="inputAddress"
                                    placeholder="track">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">linkedin</label>
                                <input type="url" class="form-control" name="linkedin" id="inputAddress"
                                    placeholder="linkedin">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">department </label>
                                <select name="department" class="form-select">
                                    <option disabled selected> Select department </option>

                                    @foreach ($departments as $item)
                                    <option value="{{ $item['id']}}">  {{$item['name'] }}  </option>

                                    @endforeach


                                </select>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
