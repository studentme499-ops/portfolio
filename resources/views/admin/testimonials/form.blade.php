@extends('layouts.admin')

@section('title', 'Testimonial — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Testimonial' : 'New Testimonial' }}</h2>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.testimonials.update', $item) : route('admin.testimonials.store') }}">
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
                    <label>Client Name</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $item->client_name ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="position" value="{{ old('position', $item->position ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Company</label>
                    <input type="text" name="company" value="{{ old('company', $item->company ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Photo URL</label>
                    <input type="text" name="photo" value="{{ old('photo', $item->photo ?? null) }}" placeholder="">
                </div>
                <div class="form-group full">
                    <label>Testimonial</label>
                    <textarea name="testimonial" rows="4">{{ old('testimonial', $item->testimonial ?? null) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Rating (1-5)</label>
                    <input type="number" name="rating" value="{{ old('rating', $item->rating ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Related Project</label>
                    <input type="text" name="project" value="{{ old('project', $item->project ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $item->is_featured ?? 0) ? "checked" : "" }}>
                        Featured
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
                <a href="{{ route('admin.testimonials.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection