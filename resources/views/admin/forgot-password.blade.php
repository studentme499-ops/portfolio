<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Amiri CMS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body style="display: flex; align-items: center; justify-content: center; min-height: 100vh;">

    <div style="background: var(--bg-card); border: 1px solid var(--border); padding: 40px; border-radius: 12px; width: 100%; max-width: 400px; text-align: center;">
        <div style="width: 36px; height: 36px; background: var(--accent); color: #fff; font-weight: 800; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin: 0 auto 16px;">A</div>
        <h2 style="font-size: 20px; margin-bottom: 6px;">Reset Password</h2>
        <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 24px;">Enter your email to receive a reset link</p>

        <form method="POST">
            @csrf
            <label style="font-size: 10px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Email Address</label>
            <input type="email" name="email" value="{{ old('email', 'amiri@example.com') }}" style="width:100%; background:#000; border:1px solid var(--border); padding:10px; border-radius:6px; color:#fff; font-size:12px; margin: 6px 0 20px; outline:none;">
            <button type="submit" class="btn-primary" style="width: 100%;">Send Reset Link</button>
        </form>

        <a href="{{ route('admin.login') }}" style="display: inline-block; font-size: 11px; color: var(--text-muted); margin-top: 20px;">&larr; Back to Login</a>
    </div>

</body>
</html>
