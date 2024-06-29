<!DOCTYPE html>
<html>
<head>
    <title>Your Account Has Been Approved</title>
</head>
<body>
    <h1>Congratulations {{ $name }}!</h1>
    <p>Your account has been approved by the admin.</p>
    <p>You can now log in using the following credentials:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p><a href="{{ $loginUrl }}">Click here to log in</a></p>
    <p>Thank you!</p>
</body>
</html>
