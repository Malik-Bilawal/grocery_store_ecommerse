<!DOCTYPE html>
<html>
<head>
<title>Grocery Station One | Verify Email </title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Click the button below to verify your email:</p>
    <a href="{{ $url }}" style="background:#4CAF50; color:white; padding:10px 15px; text-decoration:none;">
        Verify Email
    </a>
    <p>If you did not create an account, just ignore this email.</p>
</body>
</html>
