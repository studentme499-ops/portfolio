@extends('layouts.admin')

@section('title', 'Certification — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>{{ $item ? 'Edit Certification' : 'New Certification' }}</h2>
    <a href="{{ route('admin.certifications.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 860px;">
    <div class="panel-body">
        <form method="POST" action="{{ $item ? route('admin.certifications.update', $item) : route('admin.certifications.store') }}">
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
                    <label>Certificate Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Organization</label>
                    <input type="text" name="organization" value="{{ old('organization', $item->organization ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Issue Date</label>
                    <input type="date" name="issue_date" value="{{ old('issue_date', $item->issue_date ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry_date" value="{{ old('expiry_date', $item->expiry_date ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Credential ID</label>
                    <input type="text" name="credential_id" value="{{ old('credential_id', $item->credential_id ?? null) }}" placeholder="">
                </div>
                <div class="form-group">
                    <label>Credential URL</label>
                    <input type="text" name="credential_url" value="{{ old('credential_url', $item->credential_url ?? null) }}" placeholder="">
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
                <a href="{{ route('admin.certifications.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection