@extends('layouts.main')

@section('title','Teachers')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">Teachers</h4>
                    <button type="button" class="btn btn-primary ms-auto mb-3 mb-sm-0" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
                        Add Teacher
                    </button>
                    @include('teachers.add-modal')
                </div>

                <form method="GET" action="{{ route('teachers.index') }}">
                    <div class="form-group">
                        <label for="search">Search Teachers:</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search by name or email" value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                </form>

                <div class="table-responsive mt-4">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teacher->first_name }}</td>
                                <td>{{ $teacher->last_name }}</td>
                                <td>{{ $teacher->contact_no }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTeacherModal{{ $teacher->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTeacherModal{{ $teacher->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <a href="{{ route('teachers.show',$teacher->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @include('teachers.edit-modal', ['teacher' => $teacher])
                                    @include('teachers.delete-modal', ['teacher' => $teacher])
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
