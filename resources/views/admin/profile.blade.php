@extends('layouts.admin')

@section('title', 'My Profile — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>My Profile</h1>
</div>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="panel" style="max-width: 640px;">
        <div class="panel-header"><h3>Account Details</h3></div>
        <div class="panel-body">
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <div style="width: 56px; height: 56px; background: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; overflow: hidden;">
                    @if ($user->avatar)
                        <img src="{{ asset($user->avatar) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        {{ collect(explode(' ', $user->name))->map(fn ($w) => strtoupper(mb_substr($w, 0, 1)))->take(2)->implode('') }}
                    @endif
                </div>
                <div>
                    <div style="font-weight: 600;">{{ $user->role->name ?? 'No Role' }}</div>
                    <div style="font-size: 11px; color: var(--text-muted);">Last login: {{ $user->last_login_at?->diffForHumans() ?? 'Never' }}</div>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="form-group">
                    <label>Avatar</label>
                    <input type="file" name="avatar_file" accept="image/*">
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 12px;">
                    @foreach ($errors->all() as $error)
                        <div style="font-size: 12px;">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </div>
        </div>
    </div>
</form>

<div class="panel" style="max-width: 640px;">
    <div class="panel-header"><h3>Change Password</h3></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.profile.password') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="password" required minlength="8">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Password</button>
            </div>
        </form>
    </div>
</div>

<div class="panel" style="max-width: 640px;">
    <div class="panel-header"><h3>Two-Factor Authentication</h3></div>
    <div class="panel-body" style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
        <div>
            <div style="font-size: 13px; font-weight: 600;">{{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}</div>
            <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px;">Add a second layer of security to your account.</div>
        </div>
        <form method="POST" action="{{ route('admin.profile.2fa') }}">
            @csrf
            <button type="submit" class="btn {{ $user->two_factor_enabled ? 'btn-danger' : '' }}">
                {{ $user->two_factor_enabled ? 'Disable' : 'Enable' }}
            </button>
        </form>
    </div>
</div>

@endsection