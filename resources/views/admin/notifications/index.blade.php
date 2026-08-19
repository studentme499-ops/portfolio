@extends('layouts.admin')

@section('title', 'Notifications — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Notifications</h1>
    <form method="POST" action="{{ route('admin.notifications.read-all') }}">
        @csrf
        <button type="submit" class="btn btn-sm">Mark All Read</button>
    </form>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="list-stack">
            @forelse ($items as $item)
                <div class="item" style="{{ $item->read_at ? '' : 'border-color: var(--accent);' }}">
                    <div>
                        <strong style="font-size: 13px;">{{ $item->title }}</strong>
                        <div style="font-size: 12px; color: var(--text-muted);">{{ $item->body }}</div>
                        <div style="font-size: 10px; color: #555; margin-top: 4px;">{{ $item->created_at->diffForHumans() }}</div>
                    </div>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        @if (! $item->read_at)
                            <span class="badge badge-accent">New</span>
                        @endif
                        @if (! $item->read_at)
                            <form method="POST" action="{{ route('admin.notifications.read', $item) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm">Mark Read</button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.notifications.destroy', $item) }}" onsubmit="return confirm('Delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">×</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="big">🔔</div>
                    <p>No notifications.</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 16px;">{{ $items->links() }}</div>
    </div>
</div>

@endsection
