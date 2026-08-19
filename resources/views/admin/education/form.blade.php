@extends('layouts.admin')

@section('title', 'Education — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Education' : 'New Education' }}</h2>
    <a href="{{ route('admin.education.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.education.update', $item) : route('admin.education.store') }}">
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
                    <label>Institution</label>
                    <input type="text" name="institution" value="{{ old('institution', $item->institution ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Degree</label>
                    <input type="text" name="degree" value="{{ old('degree', $item->degree ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Field</label>
                    <input type="text" name="field" value="{{ old('field', $item->field ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $item->start_date ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $item->end_date ?? null) }}" placeholder="">
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
                <a href="{{ route('admin.education.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection