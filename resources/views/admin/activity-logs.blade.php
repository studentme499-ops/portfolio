@extends('layouts.admin')

@section('title', 'Activity Logs — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Activity Logs</h1>
    <form method="POST" action="{{ route('admin.activity-logs.clear') }}" onsubmit="return confirm('Clear all activity logs?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Clear All</button>
    </form>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 14px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search description..." class="search-box" style="width: 280px;">
        </form>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Time</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->user->name ?? 'System' }}</td>
                            <td>
                                <span class="badge {{ strtolower($item->action) === 'deleted' ? 'badge-danger' : (strtolower($item->action) === 'updated' ? 'badge-warning' : 'badge-success') }}">
                                    {{ $item->action }}
                                </span>
                            </td>
                            <td style="font-size: 12px;">{{ $item->description }}</td>
                            <td><code>{{ $item->ip_address }}</code></td>
                            <td style="font-size: 12px;">{{ $item->created_at->diffForHumans() }}</td>
                            <td style="text-align: right;">
                                <form method="POST" action="{{ route('admin.activity-logs.destroy', $item) }}" style="display: inline;" onsubmit="return confirm('Delete this entry?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">×</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="empty-state">No activity logged yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 14px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection