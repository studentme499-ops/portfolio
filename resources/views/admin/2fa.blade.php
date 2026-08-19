<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-body">

    <div class="auth-box">
        <div class="auth-logo">A</div>
        <h2>Two-Factor Authentication</h2>
        <p class="sub">Enter the 6-digit code from your authenticator app</p>

        @if (session('status'))
            <div class="alert alert-success" style="margin-bottom: 18px;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.2fa.verify') }}">
            @csrf

            <label for="code">Verification Code</label>
            <input type="text" id="code" name="code" placeholder="000000" maxlength="6" required autofocus>

            <button type="submit" class="btn btn-primary">Verify & Sign In</button>
        </form>

        <a href="{{ route('admin.login') }}" class="auth-link">&larr; Back to Login</a>
    </div>

</body>
</html>