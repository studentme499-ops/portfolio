<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh;">

    <div style="background: var(--bg-card); border: 1px solid var(--border); padding: 40px; border-radius: 12px; width: 100%; max-width: 380px; text-align: center;">
        <div style="width: 36px; height: 36px; background: var(--accent); color: #fff; font-weight: 800; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin: 0 auto 16px;">A</div>
        <h2 style="font-size: 20px; margin-bottom: 6px;">Admin Login</h2>
        <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 24px;">Sign in to your dashboard</p>

        @if ($errors->any())
            <div style="background: var(--warning-bg); border: 1px solid var(--warning); color: var(--warning); font-size: 12px; padding: 10px 14px; border-radius: 6px; margin-bottom: 20px; text-align: left;">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" style="text-align: left;">
            @csrf

            <label style="font-size: 10px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="amiri@example.com" required autofocus style="width:100%; background:#000; border:1px solid var(--border); padding:10px; border-radius:6px; color:#fff; font-size:12px; margin: 6px 0 14px; outline:none;">

            <label style="font-size: 10px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Password</label>
            <input type="password" name="password" required style="width:100%; background:#000; border:1px solid var(--border); padding:10px; border-radius:6px; color:#fff; font-size:12px; margin: 6px 0 14px; outline:none;">

            <label style="display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--text-muted); margin-bottom: 20px;">
                <input type="checkbox" name="remember" style="accent-color: var(--accent);"> Remember me
            </label>

            <button type="submit" class="btn-primary" style="width: 100%;">Sign In</button>
        </form>

        <a href="{{ route('admin.forgot-password') }}" style="display: inline-block; font-size: 11px; color: var(--text-muted); margin-top: 20px;">Forgot Password?</a>
    </div>

</body>
</html>