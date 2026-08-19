@extends('layouts.admin')

@section('title', 'Backups — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Backups</h1>
    <form method="POST" action="{{ route('admin.backups.create') }}">
        @csrf
        <input type="hidden" name="type" value="database">
        <button type="submit" class="btn btn-primary">+ Create Backup</button>
    </form>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="max-width: 480px;">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="panel">
    <div class="panel-body">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>Created</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td><span class="badge badge-accent">{{ ucfirst($item->type) }}</span></td>
                            <td>{{ $item->size }}</td>
                            <td>{{ $item->created_at->format('M d, Y H:i') }}</td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.backups.download', $item) }}" class="btn btn-sm">Download</a>
                                <form method="POST" action="{{ route('admin.backups.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this backup?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="big">▤</div>
                                <p>No backups yet. Create your first database backup.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection