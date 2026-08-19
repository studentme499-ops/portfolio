<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-body">

    <div class="auth-box">
        <div class="auth-logo">A</div>
        <h2>Admin Login</h2>
        <p class="sub">Sign in to your dashboard</p>

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

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label style="display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--text-muted); text-transform: none; font-weight: 400; margin-bottom: 18px;">
                <input type="checkbox" name="remember" style="accent-color: var(--accent);"> Remember me
            </label>

            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>

        <a href="{{ route('admin.forgot-password') }}" class="auth-link">Forgot Password?</a>
    </div>

</body>
</html>