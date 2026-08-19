@extends('layouts.admin')

@section('title', 'Projects — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Projects</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ New Project</a>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 14px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search projects..." class="search-box" style="width: 280px;">
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Year</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->category ?? '—' }}</td>
                            <td>{{ $item->year ?? '—' }}</td>
                            <td>
                                @if ($item->is_featured)
                                    <span class="badge badge-accent">Featured</span>
                                @else
                                    <span class="badge badge-muted">No</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $item->status === 'published' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.projects.edit', $item) }}" class="btn btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No projects yet. <a href="{{ route('admin.projects.create') }}">Create one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection
