@extends('layouts.admin')

@section('title', 'Navigation Item — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Navigation Item' : 'New Navigation Item' }}</h2>
    <a href="{{ route('admin.navigation.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.navigation.update', $item) : route('admin.navigation.store') }}">
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
                    <label>Label</label>
                    <input type="text" name="label" value="{{ old('label', $item->label ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" value="{{ old('url', $item->url ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_external" value="1" {{ old('is_external', $item->is_external ?? 0) ? "checked" : "" }}>
                        External URL
                    </label>
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
                <a href="{{ route('admin.navigation.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection