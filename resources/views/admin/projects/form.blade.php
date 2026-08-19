@extends('layouts.admin')

@section('title', 'Project — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Project' : 'New Project' }}</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 900px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.projects.update', $item) : route('admin.projects.store') }}">
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
                <div class="form-group full">
                    <label>Project Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category">
                        <option value="">— Select —</option>
                        @foreach (['SaaS', 'Web Application', 'Mobile App', 'Healthcare', 'E-Commerce', 'Developer Tool', 'API', 'Enterprise', 'Other'] as $cat)
                            <option value="{{ $cat }}" {{ old('category', $item->category ?? null) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input type="text" name="year" value="{{ old('year', $item->year ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        @foreach (['draft', 'published'] as $s)
                            <option value="{{ $s }}" {{ old('status', $item->status ?? 'draft') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Client</label>
                    <input type="text" name="client" value="{{ old('client', $item->client ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                </div>
                <div class="form-group full">
                    <label>Featured Image URL</label>
                    <input type="text" name="featured_image" value="{{ old('featured_image', $item->featured_image ?? null) }}">
                </div>
                <div class="form-group full">
                    <label>Short Description</label>
                    <textarea name="short_description" rows="3">{{ old('short_description', $item->short_description ?? null) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Full Description</label>
                    <textarea name="full_description" rows="8">{{ old('full_description', $item->full_description ?? null) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Project URL</label>
                    <input type="url" name="project_url" value="{{ old('project_url', $item->project_url ?? null) }}">
                </div>
                <div class="form-group">
                    <label>GitHub URL</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $item->github_url ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Demo URL</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $item->demo_url ?? null) }}">
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $item->is_featured ?? 0) ? 'checked' : '' }}>
                        Featured
                    </label>
                </div>
                <div class="form-group full">
                    <label>Technologies (hold Ctrl/Cmd to multi-select)</label>
                    <select name="technologies[]" multiple style="min-height: 120px;">
                        @foreach ($technologies as $tech)
                            <option value="{{ $tech->name }}" {{ $item && in_array($tech->name, $item->technologies ?? []) ? 'selected' : '' }}>{{ $tech->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group full">
                    <label>Gallery URLs (one per line)</label>
                    <textarea name="gallery[]" rows="3" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg">{{ $item && $item->gallery ? implode("\n", $item->gallery) : '' }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.projects.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
