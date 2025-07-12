
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
                        <h5 class="card-title">List student
                            <a class="btn btn-info float-end" href="{{ route('student.index') }}">Back </a>
                        </h5>
                        {{-- User + admin --}}
                        <!-- Vertical Form -->
                        <form method="post" action="{{ route('student.store') }}" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">student Name</label>
                                <input type="text" name="name" class="form-control" id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="inputEmail4">
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">college</label>
                                <input type="text" class="form-control" name="college" id="inputAddress"
                                    placeholder="college">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">degree</label>
                                <input type="text" class="form-control" name="degree" id="inputAddress"
                                    placeholder="degree">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">groups </label>
                                <select name="group_id" class="form-select">
                                    <option disabled selected> Select group </option>

                                    @foreach ($groups as $item)
                                    <option value="{{ $item['id']}}">  {{$item['name'] .$item->round->titel }}  </option>

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
