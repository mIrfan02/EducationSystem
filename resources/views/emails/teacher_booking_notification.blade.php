<!DOCTYPE html>
<html>
<head>
    <title>New Booking Notification</title>
</head>
<body>
    <h1>New Booking Notification</h1>
    <p>Dear Teacher,</p>
    <p>You have a new booking for the following meeting:</p>
    <ul>
        <li>Title: {{ $title }}</li>
        <li>Start Time: {{ $start_time }}</li>
        <li>End Time: {{ $end_time }}</li>
        <li>Meeting Link: <a href="{{ $meeting_link }}">{{ $meeting_link }}</a></li>
    </ul>
    <p>Thank you for using our service!</p>
</body>
</html>
