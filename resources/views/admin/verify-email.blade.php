<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-body">

    <div class="auth-box">
        <div class="auth-logo">A</div>
        <h2>Verify Your Email</h2>
        <p class="sub">A verification link has been sent to your email address. Please click the link to verify your account.</p>

        @if (session('status'))
            <div class="alert alert-success" style="margin-bottom: 18px;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.verify-email') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Resend Verification Email</button>
        </form>

        <a href="{{ route('admin.login') }}" class="auth-link">&larr; Back to Login</a>
    </div>

</body>
</html>