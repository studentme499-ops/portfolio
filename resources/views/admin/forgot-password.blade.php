<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-body">

    <div class="auth-box">
        <div class="auth-logo">A</div>
        <h2>Reset Password</h2>
        <p class="sub">Enter your email to receive a reset link</p>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom: 18px; text-align: left;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success" style="margin-bottom: 18px; text-align: left;">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.forgot-password.post') }}">
            @csrf

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', 'amiri@example.com') }}" required autofocus>

            <button type="submit" class="btn btn-primary">Send Reset Link</button>
        </form>

        <a href="{{ route('admin.login') }}" class="auth-link">&larr; Back to Login</a>
    </div>

</body>
</html>