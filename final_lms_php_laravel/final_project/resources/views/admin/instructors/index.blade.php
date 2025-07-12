@extends('admin.layout.app')


@section('content')
    <div class="pagetitle">
        <h1>instructors Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('instructor.index') }}">Home</a></li>
                <li class="breadcrumb-item">instructor</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">instructor List
                            <a href="{{ route('instructor.create') }}" class="btn btn-primary float-end">Add New
                             </a>
                        </h5>

                        <table class="table table-hover table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">track</th>
                                    <th scope="col">department</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($insructors as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->track}}</td>
                                        <td>{{ $item->departments->name}}</td>

                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('instructor.show', $item->id) }}">Show</a>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('instructor.edit', $item->id) }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                href="{{ route('instructor.destroy', $item->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
