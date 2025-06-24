@extends('layouts.app')

@section('content')
    <div class="container col-md-8">
        <div class="card">


            <h5> Create department
                <a class="float-end" href="{{ route('department.index') }}"> Back</a>
            </h5>
            <div class="card-body">

                <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">department name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="##">description</label>
                        <input type="text" id="##" name="description" class="form-control" placeholder="description">
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-info">submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
