@extends('layouts.app')

@section('content')
    <div class="container col-md-8">
        <div class="card">


            <h5> Create Employees
                <a class="float-end" href="{{ route('employee.index') }}"> Back</a>
            </h5>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <div class="card-body">
                <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
@csrf
                    <div class="form-group">
                        <label for="name">Employee name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="name">
                    </div>
                    <div class="form-group">
                        <label for="salary">Employee salary</label>
                        <input type="number" id="salary" name="salary" class="form-control" placeholder="salary">
                    </div>
                    <div class="form-group">
                        <label for="image">Employee image</label>
                        <input type="file" id="image" name="image" class="form-control" placeholder="image">
                    </div>
                    <div class="form-group">
                        <label for="sel">Employee department</label>
                        <select name="department_id" class="form-select" id="sel">
                            <option selected disabled>Select department</option>
                            @foreach ($deparments as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-info">submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
