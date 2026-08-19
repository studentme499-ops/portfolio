@extends('layouts.admin')

@section('title', 'Testimonials — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">+ New</a>
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
                        <th>Client</th>
                        <th>Company</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                        <td><strong>{{ $item->client_name }}</strong></td>
                        <td>{{ $item->company }}</td>
                        <td>{{ $item->rating }}</td>
                        <td>
                                @if (isset($item->is_active))
                                    <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-muted' }}">{{ $item->is_active ? 'Active' : 'Inactive' }}</span>
                                @endif
                                @if (isset($item->status))
                                    <span class="badge {{ $item->status === 'published' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.testimonials.edit', $item) }}" class="btn btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="10" class="empty-state">No items yet. <a href="{{ route('admin.testimonials.create') }}">Create one</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection