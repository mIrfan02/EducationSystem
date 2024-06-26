<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Dear Student,</p>
    <p>Your booking has been confirmed for the following meeting:</p>
    <ul>
        <li>Title: {{ $title }}</li>
        <li>Start Time: {{ $start_time }}</li>
        <li>End Time: {{ $end_time }}</li>
        <li>Meeting Link: <a href="{{ $meeting_link }}">{{ $meeting_link }}</a></li>
    </ul>
    <p>Thank you for using our service!</p>
</body>
</html>
