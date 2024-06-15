@extends('layouts.main')

@section('title','Teachers')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <button type="button" class="btn btn-primary ms-auto mb-3 mb-sm-0" data-bs-toggle="modal" data-bs-target="#addCourseTeacher">
                        Assign Course
                    </button>
                    @include('teachers.assign')
                </div>

                <div class="table-responsive">
                    <table id="#" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



{{-- assinged coursess --}}

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">Teacher And Assigned Courses</h4>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Teacher</th>
                                <th>Course</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedCourses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $course->title }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTeachCourseModal{{ $course->pivot->id }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $course->pivot->id}}">
                                        Delete
                                    </button>
                                    @include('teachers.edit-assing', ['course' => $course])
                                    @include('teachers.delete-assign', ['course' => $course])
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
