@extends('layouts.admin')

@section('title', 'Blog Categories — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Blog Categories</h1>
    <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">+ New</a>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 14px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." class="search-box" style="width: 280px;">
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                        <td><strong>{{ $item->name }}</strong></td>
                        <td>{{ $item->slug }}</td>
                        <td>
                                @if (isset($item->is_active))
                                    <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-muted' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                                @endif
                                @if (isset($item->status))
                                    <span class="badge {{ $item->status === 'published' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.blog-categories.edit', $item) }}" class="btn btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.blog-categories.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10" class="empty-state">No items yet. <a href="{{ route('admin.blog-categories.create') }}">Create one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection