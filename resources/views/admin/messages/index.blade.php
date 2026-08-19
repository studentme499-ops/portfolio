@extends('layouts.admin')

@section('title', 'Messages — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Messages</h1>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 14px; display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search..." class="search-box">
            <select name="status" class="search-box" style="width: 150px; background: var(--bg-card); border: 1px solid var(--border); color: #fff;">
                <option value="">All Statuses</option>
                @foreach (['unread', 'read', 'replied', 'archived', 'spam'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button class="btn btn-sm" type="submit">Filter</button>
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr style="{{ $item->status === 'unread' ? 'background: var(--accent-light);' : '' }}">
                            <td><strong>{{ $item->name }}</strong></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->subject ?? '—' }}</td>
                            <td>{{ $item->created_at->format('M d, Y') }}</td>
                            <td>
                                @if ($item->status === 'unread')
                                    <span class="badge badge-danger">Unread</span>
                                @elseif ($item->status === 'read')
                                    <span class="badge badge-info">Read</span>
                                @elseif ($item->status === 'replied')
                                    <span class="badge badge-success">Replied</span>
                                @elseif ($item->status === 'archived')
                                    <span class="badge badge-muted">Archived</span>
                                @else
                                    <span class="badge badge-warning">Spam</span>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="{{ route('admin.messages.show', $item) }}" class="btn btn-sm">View</a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No messages found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection
