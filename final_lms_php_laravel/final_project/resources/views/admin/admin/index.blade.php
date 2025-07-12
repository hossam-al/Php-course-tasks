@extends('admin.layout.app')


@section('content')





    <div class="pagetitle">
        <h1>Admin Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item">Admin</li>
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
                      @if (Session::has('ERORR'))
                        <div class="alert alert-danger">
                            {{ Session::get('ERORR') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Admin List
                            <a href="{{ route('admin.create') }}" class="btn btn-primary float-end">Add New Admin</a>
                        </h5>

                        <table class="table table-hover table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->position }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('admin.show', $item->id) }}">Show</a>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('admin.edit', $item->id) }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                href="{{ route('admin.destroy', $item->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
  {{ $admins->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
