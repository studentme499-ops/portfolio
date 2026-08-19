@extends('layouts.admin')

@section('title', 'Service — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Service' : 'New Service' }}</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.services.update', $item) : route('admin.services.store') }}">
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
                    <label>Service Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $item->icon ?? null) }}" placeholder="">
                </div>
                <div class="form-group full">
                    <label>Short Description</label>
                    <textarea name="short_description" rows="4">{{ old('short_description', $item->short_description ?? null) }}</textarea>
                </div>
                <div class="form-group full">
                    <label>Full Description</label>
                    <textarea name="full_description" rows="4">{{ old('full_description', $item->full_description ?? null) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Price / Starting From</label>
                    <input type="text" name="price" value="{{ old('price', $item->price ?? null) }}" placeholder="">
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
                <div class="form-group full">
                    <label>Features (one per line)</label>
                    <textarea name="features[]" rows="3" placeholder="One item per line">{{ $item->features ?? null ? implode("\n", $item->features) : "" }}</textarea>
                    <div class="form-help">Enter each item on its own line.</div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.services.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection