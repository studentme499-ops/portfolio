@extends('layouts.admin')

@section('title', ($item ? 'Edit' : 'Create').' Role — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Role' : 'Create Role' }}</h2>
    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 680px;">
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ $item ? route('admin.roles.update', $item) : route('admin.roles.store') }}">
            @csrf
            @if ($item)
                @method('PUT')
            @endif

            <div class="form-grid">
                <div class="form-group">
                    <label>Role Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label>Slug (optional)</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug ?? '') }}" placeholder="auto-generated">
                </div>
            </div>

            <div class="form-group">
                <label>Permissions</label>
                <div class="permissions-grid">
                    @foreach ($permissions as $group => $perms)
                        <div class="perm-group">
                            <div class="perm-group-title">{{ $group }}</div>
                            @foreach ($perms as $perm)
                                @php
                                    $checked = $item && in_array($perm, $item->permissions ?? [], true);
                                @endphp
                                <label class="form-check">
                                    <input type="checkbox" name="permissions[]" value="{{ $perm }}" {{ $checked ? 'checked' : '' }}>
                                    <span style="text-transform: capitalize;">{{ str_replace('.', ' › ', $perm) }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">{{ $item ? 'Save Changes' : 'Create Role' }}</button>
            </div>
        </form>
    </div>
</div>

@endsection