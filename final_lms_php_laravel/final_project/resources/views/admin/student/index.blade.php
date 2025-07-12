@extends('admin.layout.app')


@section('content')
    <div class="pagetitle">
        <h1>students Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.index') }}">Home</a></li>
                <li class="breadcrumb-item">student</li>
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
                        <h5 class="card-title">student List
                            <a href="{{ route('student.create') }}" class="btn btn-primary float-end">Add New
                             </a>
                        </h5>

                        <table class="table table-hover table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">college</th>
                                    <th scope="col">degree</th>
                                    <th scope="col">group</th>
                                    <th scope="col">round</th>

                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->college }}</td>
                                        <td>{{ $item->degree }}</td>
                                        <td>{{ $item->group->name }}</td>
                                        <td>{{ $item->group->round->titel }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('student.show', $item->id) }}">Show</a>
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('student.edit', $item->id) }}">Edit</a>
                                            <a class="btn btn-sm btn-danger"
                                                href="{{ route('student.destroy', $item->id) }}">Delete</a>
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
