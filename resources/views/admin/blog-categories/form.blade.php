@extends('layouts.admin')

@section('title', 'Blog Category — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Blog Category' : 'New Blog Category' }}</h2>
    <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.blog-categories.update', $item) : route('admin.blog-categories.store') }}">
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
                    <label>Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $item->slug ?? null) }}" placeholder="">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.blog-categories.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection