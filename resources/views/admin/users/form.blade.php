@extends('layouts.admin')

@section('title', ($item ? 'Edit' : 'Create').' User — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit User' : 'Create User' }}</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 560px;">
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ $item ? route('admin.users.update', $item) : route('admin.users.store') }}">
            @csrf
            @if ($item)
                @method('PUT')
            @endif

            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $item->email ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role_id">
                        <option value="">— No role —</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id', $item->role_id ?? '') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Password {{ $item ? '(leave blank to keep)' : '' }}</label>
                    <input type="password" name="password" {{ $item ? '' : 'required' }} minlength="8">
                </div>
                <div class="form-group full">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                        Active account
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">{{ $item ? 'Save Changes' : 'Create User' }}</button>
            </div>
        </form>
    </div>
</div>

@endsection