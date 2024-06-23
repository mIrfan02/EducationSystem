@extends('layouts.main')

@section('title', 'Teachers')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">Teachers</h4>
                    <button type="button" class="btn btn-primary ms-auto mb-3 mb-sm-0" data-bs-toggle="modal" data-bs-target="#addSessionModal">
                        Add Sessions
                    </button>
                    @include('teacher.add-session-modal')
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Title</th>
                                <th>Meeting Link</th>
                                <th>Fee/Hr</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index=0;
                            @endphp
                            @foreach($sessions as $session)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $session->date }}</td>
                                <td>{{ $session->start_time }}</td>
                                <td>{{ $session->end_time }}</td>
                                <td>{{ $session->title }}</td>
                                <td>{{ $session->meeting_link }}</td>
                                <td>{{ $session->fee_per_hour }} $</td>
                                <td>{{ $session->session_type ?? 'N/A' }} </td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editSessionModal{{ $session->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSessionModal{{ $session->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    @include('teacher.edit-modal', ['session' => $session])
                                    @include('teacher.delete-modal', ['session' => $session])
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
