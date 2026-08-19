@extends('layouts.admin')

@section('title', 'Social Link — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Social Link' : 'New Social Link' }}</h2>
    <a href="{{ route('admin.social-links.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.social-links.update', $item) : route('admin.social-links.store') }}">
            @csrf
            {{ $item ? method_field('PUT') : "" }}

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="form-grid">
                <div class="form-group">
                    <label>Platform</label>
                    <input type="text" name="platform" value="{{ old('platform', $item->platform ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $item->icon ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" value="{{ old('url', $item->url ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="{{ old('username', $item->username ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? 0) ? "checked" : "" }}>
                        Active
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.social-links.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection