@extends('layouts.admin')

@section('title', 'Upload Media — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>Upload File</h2>
    <a href="{{ route('admin.media.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel" style="max-width: 560px;">
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>File</label>
                <input type="file" name="file" required style="color: #fff; background: #000; border: 1px solid var(--border); padding: 10px; border-radius: 6px; width: 100%;">
                <div class="form-help">Images, PDF, DOC, ZIP. Max 10MB.</div>
            </div>

            <div class="form-group">
                <label>Collection</label>
                <select name="collection">
                    <option value="general">General</option>
                    <option value="projects">Projects</option>
                    <option value="profile">Profile</option>
                    <option value="logos">Company Logos</option>
                    <option value="certificates">Certificates</option>
                    <option value="documents">Documents</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>

@endsection
