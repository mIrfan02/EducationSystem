
@extends('layouts.main')

@section('title', 'Bookings with Commission')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Bookings with Commission</h4>
                <div class="table-responsive">
                    <table id="bookingsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Teacher</th>
                                <th>Meeting</th>
                                <th>Fee per Hour</th>
                                <th>Commission Rate (%)</th>
                                <th>Commission Amount (Admin Earnings)</th>
                                <th>Earnings After Commission (Teacher Earnings)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookingsWithEarnings as $booking)
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->teacher->name }}</td>
                                <td>{{ $booking->meeting->title }}</td>
                                <td>{{ $booking->meeting->fee_per_hour }}</td>
                                <td>{{ $booking->commission_rate }}</td>
                                <td>{{ $booking->commission_amount }}</td>
                                <td>{{ $booking->earnings_after_commission }}</td>
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
            $('#bookingsTable').DataTable();
        });
    </script>
@endsection
