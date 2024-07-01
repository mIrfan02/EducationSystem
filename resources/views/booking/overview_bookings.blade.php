



@extends('layouts.main')

@section('title', 'Boookings Details')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Overview of Bookings</h4>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Teacher</th>
                                <th>Student</th>
                                <th>Meeting</th>
                                <th>Booking Date</th>
                                <th>Session Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->teacher->first_name.' '.$booking->teacher->last_name }}</td>
                                <td>{{ $booking->student->first_name.' '.$booking->student->last_name }}</td>
                                <td>{{ $booking->meeting->title }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->session_date }}</td>
                                <td>{{ $booking->start_time }}</td>
                                <td>{{ $booking->end_time }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>{{ $booking->comments }}</td>
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
