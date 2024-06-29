@extends('layouts.main')

@section('title', 'My Bookings')

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
                <h4 class="card-title">My Bookings</h4>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Meeting Title</th>
                                <th>Booking Date</th>
                                <th>Session Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Time Remaining</th> <!-- New column for countdown timer -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->meeting->title }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->session_date }}</td>
                                <td>{{ $booking->start_time }}</td>
                                <td>{{ $booking->end_time }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    <span id="time_remaining_{{ $booking->id }}" class="timer">
                                        {{ $booking->time_remaining }}
                                    </span>
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


<script>
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
                    document.getElementById('time_remaining_{{ $booking->id }}').innerText = 'Session in progress';
                } else {
                    var hours = Math.floor(secondsRemaining / 3600);
                    var minutes = Math.floor((secondsRemaining % 3600) / 60);
                    var seconds = secondsRemaining % 60;

                    var formattedTime = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);

                    document.getElementById('time_remaining_{{ $booking->id }}').innerText = formattedTime;
                }
            @endforeach
        }

        // Update timers initially
        updateTimers();

        // Update timers every second
        setInterval(updateTimers, 1000);
    });
</script>
