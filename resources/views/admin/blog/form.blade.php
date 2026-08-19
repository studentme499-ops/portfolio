@extends('layouts.admin')

@section('title', 'Blog Post — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Post' : 'New Post' }}</h2>
    <a href="{{ route('admin.blog.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.blog.update', $item) : route('admin.blog.store') }}">
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
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $item->title ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id">
                        <option value="">— Select —</option>
                        @foreach (\App\Models\BlogCategory::orderBy('name')->get() as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id ?? null) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        @foreach (['draft', 'published', 'scheduled', 'archived'] as $s)
                            <option value="{{ $s }}" {{ old('status', $item->status ?? 'draft') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Featured Image URL</label>
                    <input type="text" name="featured_image" value="{{ old('featured_image', $item->featured_image ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" value="{{ old('author', $item->author ?? null) }}">
                </div>
                <div class="form-group">
                    <label>Publish Date</label>
                    <input type="datetime-local" name="publish_date" value="{{ old('publish_date', $item->publish_date ?? null) }}">
                </div>
                <div class="form-group full">
                    <label>Excerpt</label>
                    <textarea name="excerpt" rows="3">{{ old('excerpt', $item->excerpt ?? null) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Content</label>
                    <textarea name="content" rows="12">{{ old('content', $item->content ?? null) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Tags (one per line)</label>
                    <textarea name="tags[]" rows="3" placeholder="laravel&#10;react&#10;devops">{{ $item && $item->tags ? implode("\n", $item->tags) : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $item->seo_title ?? null) }}">
                </div>
                <div class="form-group">
                    <label>SEO Description</label>
                    <input type="text" name="seo_description" value="{{ old('seo_description', $item->seo_description ?? null) }}">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.blog.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
