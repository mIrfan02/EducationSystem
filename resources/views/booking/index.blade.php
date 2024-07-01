@extends('layouts.main')

@section('title', 'Teachers')

@section('content')
<style>
    .timer {
        background-color: #007bff; /* Blue background */
        color: #fff; /* White text color */
        padding: 5px 10px;
        border-radius: 3px;
        display: inline-block;
    }
    </style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">Bookings</h4>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student</th>
                                <th>Meeting</th>
                                <th>Start Time</th>
                                <th>End Time</th>

                                <th>Session Date</th>
                                <th>Booking Date</th>
                                <th>Payment Status</th>
                                <th>Time Remaining</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->student->first_name }} {{ $booking->student->last_name }}</td>
                                    <td>{{ $booking->meeting->title }}</td>
                                    <td>{{ $booking->start_time }}</td>
                                    <td>{{ $booking->end_time }}</td>

                                    <td>{{ $booking->session_date }}</td>
                                    <td>{{ $booking->booking_date }}</td>
                                    <td>{{ $booking->status }}</td>
                                    <td>
                                        <span id="time_remainings_{{ $booking->id }}" class="timer">
                                            {{ $booking->time_remaining }}
                                        </span>
                                    </td>
                                    <td>

                                            <a href="{{ $booking->meeting->meeting_link }}" target="_blank" class="btn btn-sm btn-primary">Join Now</a>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#rescheduleModal{{ $booking->id }}">Reschedule</button>


                                            <div class="modal fade" id="rescheduleModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="rescheduleModalLabel{{ $booking->id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rescheduleModalLabel{{ $booking->id }}">Reschedule Meeting</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('teacher.reschedule', $booking->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="start_time">New Start Time</label>
                                                                    <input type="time" class="form-control" id="start_time" name="start_time" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end_time">New End Time</label>
                                                                    <input type="time" class="form-control" id="end_time" name="end_time" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="session_date">New Session Date</label>
                                                                    <input type="date" class="form-control" id="session_date" name="session_date" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                                 <!-- Reschedule Modal for each booking -->

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<script>

</script>

@section('scripts')
    <!-- DataTables -->
    <!-- Example CDN links for Bootstrap 5 and jQuery 3.6 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).on('click', '[data-toggle="modal"]', function () {
    var target = $(this).data('target');
    $(target).modal('show');
});

</script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
        document.addEventListener('DOMContentLoaded', function () {
        console.log('Document loaded');

        // Function to update countdown timers
        function updateTimers() {
            console.log('Updating timers...');
            @foreach ($bookings as $booking)
                var sessionDateTime{{ $booking->id }} = new Date('{{ $booking->session_date }}T{{ $booking->start_time }}');
                var now = new Date();

                var secondsRemaining = Math.floor((sessionDateTime{{ $booking->id }} - now) / 1000);

                if (secondsRemaining <= 0) {
                    document.getElementById('time_remainings_{{ $booking->id }}').innerText = 'Session in progress';
                } else {
                    var hours = Math.floor(secondsRemaining / 3600);
                    var minutes = Math.floor((secondsRemaining % 3600) / 60);
                    var seconds = secondsRemaining % 60;

                    var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

                    document.getElementById('time_remainings_{{ $booking->id }}').innerText = formattedTime;
                }
            @endforeach
        }

        // Update timers initially
        updateTimers();

        // Update timers every second
        setInterval(updateTimers, 1000);
    });
    </script>
@endsection
