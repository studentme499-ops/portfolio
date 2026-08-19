@extends('layouts.admin')

@section('title', 'Blog — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Blog Posts</h1>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">+ New Post</a>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 14px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search posts..." class="search-box" style="width: 280px;">
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td><strong>{{ $item->title }}</strong></td>
                            <td>{{ $item->category?->name ?? '—' }}</td>
                            <td>{{ $item->author ?? '—' }}</td>
                            <td>
                                @if ($item->status === 'published')
                                    <span class="badge badge-success">Published</span>
                                @elseif ($item->status === 'scheduled')
                                    <span class="badge badge-info">Scheduled</span>
                                @elseif ($item->status === 'archived')
                                    <span class="badge badge-muted">Archived</span>
                                @else
                                    <span class="badge badge-warning">Draft</span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.blog.edit', $item) }}" class="btn btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.blog.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">No posts yet. <a href="{{ route('admin.blog.create') }}">Write your first post</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection
