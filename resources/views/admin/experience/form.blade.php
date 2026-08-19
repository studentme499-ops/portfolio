@extends('layouts.admin')

@section('title', 'Experience — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Experience' : 'New Experience' }}</h2>
    <a href="{{ route('admin.experience.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.experience.update', $item) : route('admin.experience.store') }}">
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
                    <label>Company</label>
                    <input type="text" name="company" value="{{ old('company', $item->company ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Position</label>
                    <input type="text" name="position" value="{{ old('position', $item->position ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Employment Type</label>
                    <select name="employment_type">
                        <option value="">— Select —</option>
                                <option value="Full-time" {{ old('employment_type', $item->employment_type ?? null) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                <option value="Part-time" {{ old('employment_type', $item->employment_type ?? null) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                <option value="Contract" {{ old('employment_type', $item->employment_type ?? null) == 'Contract' ? 'selected' : '' }}>Contract</option>
                                <option value="Freelance" {{ old('employment_type', $item->employment_type ?? null) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="Internship" {{ old('employment_type', $item->employment_type ?? null) == 'Internship' ? 'selected' : '' }}>Internship</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $item->start_date ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $item->end_date ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $item->location ?? null) }}" placeholder="">
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
                        <input type="checkbox" name="is_current" value="1" {{ old('is_current', $item->is_current ?? 0) ? "checked" : "" }}>
                        Currently working here
                    </label>
                </div>
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? 0) ? "checked" : "" }}>
                        Active
                    </label>
                </div>
                <div class="form-group full">
                    <label>Responsibilities (one per line)</label>
                    <textarea name="responsibilities[]" rows="3" placeholder="One item per line">{{ $item->responsibilities ?? null ? implode("\n", $item->responsibilities) : "" }}</textarea>
                    <div class="form-help">Enter each item on its own line.</div>
                </div>
                <div class="form-group full">
                    <label>Technologies (one per line)</label>
                    <textarea name="technologies[]" rows="3" placeholder="One item per line">{{ $item->technologies ?? null ? implode("\n", $item->technologies) : "" }}</textarea>
                    <div class="form-help">Enter each item on its own line.</div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.experience.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection