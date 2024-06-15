@extends('layouts.main')

@section('title','Categories')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">Courses</h4>
                    <button type="button" class="btn btn-primary ms-auto mb-3 mb-sm-0" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                        Add Course
                    </button>
                    @include('courses.add-modal')
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->description }}</td>

                                <td>{{ $course->category->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCourseModal{{ $course->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseModal{{ $course->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @include('courses.edit-modal', ['course' => $course])
                                    @include('courses.delete-modal', ['course' => $course])


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
