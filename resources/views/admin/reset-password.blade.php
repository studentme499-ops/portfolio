<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-body">

    <div class="auth-box">
        <div class="auth-logo">A</div>
        <h2>Set New Password</h2>
        <p class="sub">Choose a new password for your account</p>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 18px; text-align: left;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.reset-password.post') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required autofocus>

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>

        <a href="{{ route('admin.login') }}" class="auth-link">&larr; Back to Login</a>
    </div>

</body>
</html>