@extends('layouts.admin')

@section('title', 'Technology — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Technology' : 'New Technology' }}</h2>
    <a href="{{ route('admin.technologies.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.technologies.update', $item) : route('admin.technologies.store') }}">
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
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="">— Select —</option>
                                <option value="Frontend" {{ old('category', $item->category ?? null) == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                                <option value="Backend" {{ old('category', $item->category ?? null) == 'Backend' ? 'selected' : '' }}>Backend</option>
                                <option value="Database" {{ old('category', $item->category ?? null) == 'Database' ? 'selected' : '' }}>Database</option>
                                <option value="DevOps" {{ old('category', $item->category ?? null) == 'DevOps' ? 'selected' : '' }}>DevOps</option>
                                <option value="Cloud" {{ old('category', $item->category ?? null) == 'Cloud' ? 'selected' : '' }}>Cloud</option>
                                <option value="Tools" {{ old('category', $item->category ?? null) == 'Tools' ? 'selected' : '' }}>Tools</option>
                                <option value="Mobile" {{ old('category', $item->category ?? null) == 'Mobile' ? 'selected' : '' }}>Mobile</option>
                                <option value="Other" {{ old('category', $item->category ?? null) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Icon (emoji or symbol)</label>
                    <input type="text" name="icon" value="{{ old('icon', $item->icon ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" value="{{ old('color', $item->color ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Experience Level</label>
                    <input type="text" name="experience_level" value="{{ old('experience_level', $item->experience_level ?? null) }}" placeholder="e.g. Advanced">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" rows="4">{{ old('description', $item->description ?? null) }}</textarea>
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
                <a href="{{ route('admin.technologies.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection