@extends('layouts.admin')

@section('title', 'Security — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Security</h1>
</div>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="panel" style="max-width: 560px;">
    <div class="panel-header"><h3>Change Password</h3></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.security.password') }}">
            @csrf
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" required minlength="8">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="new_password_confirmation" required>
            </div>
            @error('current_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
        </form>
    </div>
</div>

<div class="panel" style="max-width: 560px;">
    <div class="panel-header"><h3>Two-Factor Authentication</h3></div>
    <div class="panel-body" style="display: flex; align-items: center; justify-content: space-between; gap: 16px;">
        <div>
            <div style="font-size: 13px; font-weight: 600;">{{ $user->two_factor_enabled ? 'Enabled' : 'Disabled' }}</div>
            <div style="font-size: 11px; color: var(--text-muted); margin-top: 4px;">Requires a verification code at login.</div>
        </div>
        <form method="POST" action="{{ route('admin.security.2fa') }}">
            @csrf
            <input type="hidden" name="enabled" value="{{ $user->two_factor_enabled ? 0 : 1 }}">
            <button type="submit" class="btn {{ $user->two_factor_enabled ? 'btn-danger' : '' }}">
                {{ $user->two_factor_enabled ? 'Disable' : 'Enable' }}
            </button>
        </form>
    </div>
</div>

<div class="panel" style="max-width: 560px;">
    <div class="panel-header"><h3>Active Sessions</h3></div>
    <div class="panel-body">
        <p style="font-size: 12px; color: var(--text-muted); margin-bottom: 14px;">Sign out all other active sessions on this account. This requires your current password.</p>
        <form method="POST" action="{{ route('admin.security.sessions') }}">
            @csrf
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Revoke Other Sessions</button>
            </div>
        </form>
    </div>
</div>

@endsection