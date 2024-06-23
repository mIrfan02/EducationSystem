<!DOCTYPE html>
<html>
<head>
    <title>Your Teacher Account Credentials</title>
</head>
<body>
    <h1>Welcome to Dashboard</h1>
    <p>Dear Teacher,</p>
    <p>Your account has been created successfully. Below are your login credentials:</p>
    <p>Email: {{ $email }}</p>
    <p>Password: {{ $password }}</p>
    <p>Login URL: <a href="{{ route('login') }}">{{ route('login') }}</a></p>
    <p>Please use the above credentials to log in to your account.</p>
    <p>Thank you!</p>
</body>
</html>
