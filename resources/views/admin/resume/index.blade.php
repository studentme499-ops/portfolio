@extends('layouts.admin')

@section('title', 'Resume / CV — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Resume / CV</h1>
</div>

<div class="panel" style="max-width: 640px;">
    <div class="panel-header"><h3>Upload New CV</h3></div>
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.resume.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label>PDF File</label>
                    <input type="file" name="file" accept=".pdf" required>
                </div>
                <div class="form-group">
                    <label>Version</label>
                    <input type="text" name="version" placeholder="e.g. v2 (2026)">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Upload & Set Active</button>
            </div>
        </form>
    </div>
</div>

<div class="panel">
    <div class="panel-header"><h3>CV Versions</h3></div>
    <div class="panel-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Version</th>
                        <th>Size</th>
                        <th>Active</th>
                        <th>Uploaded</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td><strong>{{ $item->filename }}</strong></td>
                            <td>{{ $item->version }}</td>
                            <td>{{ $item->size }}</td>
                            <td>
                                @if ($item->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-muted">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td style="text-align: right; white-space: nowrap;">
                                @if (! $item->is_active)
                                    <form method="POST" action="{{ route('admin.resume.activate', $item) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm">Set Active</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.resume.download', $item) }}" class="btn btn-sm">Download</a>
                                <form method="POST" action="{{ route('admin.resume.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this CV?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No CV uploaded yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
