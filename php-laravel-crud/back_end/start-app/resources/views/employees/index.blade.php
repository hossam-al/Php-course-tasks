@extends('layouts.app')

@section('content')
    <div class="container col-md-8">
        <div class="card">


            <h5> List Employees
                <a class="float-end" href="{{ route('employee.create') }}"> Create New</a>
            </h5>
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <div class="card-body">
                <table class="table table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Salary</th>
                        <th>Department</th>
                        <th  colspan="3">Action</th>
                    </tr>

                    @foreach ($employees as $item)
                        <tr>
                            <th>{{ $loop->iteration	}}</th>
                            <th>{{ $item->name }}</th>
                            <th>{{ $item->salary }}</th>
                            <th>{{ $item->department->name }}</th>
<th><a href="{{route("employee.show", $item->id)}}">view</a></th>
<th><a href="{{route("employee.edit", $item->id)}}">edit</a></th>
<th><a href="{{route("employee.destroy", $item->id)}}">delete</a></th>

                        </tr>
                    @endforeach

                </table>

                {{ $employees->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
