@extends('layouts.admin')

@section('title', 'Message — Amiri CMS')

@section('content')

<div class="page-header">
    <h2>Message from {{ $item->name }}</h2>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm">&larr; Back</a>
</div>

<div class="panel">
    <div class="panel-body">
        <div class="kv"><span class="k">Name</span><span>{{ $item->name }}</span></div>
        <div class="kv"><span class="k">Email</span><a href="mailto:{{ $item->email }}">{{ $item->email }}</a></div>
        <div class="kv"><span class="k">Subject</span><span>{{ $item->subject ?? '—' }}</span></div>
        <div class="kv"><span class="k">Received</span><span>{{ $item->created_at->format('M d, Y H:i') }}</span></div>
        <div class="kv"><span class="k">Status</span>
            <span>
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
            </span>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-header"><h3>Message</h3></div>
    <div class="panel-body">
        <p style="color: var(--text-muted); font-size: 13px; line-height: 1.7;">{{ $item->message }}</p>
    </div>
</div>

<div class="panel">
    <div class="panel-header"><h3>Reply / Update</h3></div>
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.messages.update', $item) }}">
            @csrf

            <div class="form-grid">
                <div class="form-group full">
                    <label>Reply</label>
                    <textarea name="reply" rows="5" placeholder="Write a reply...">{{ old('reply', $item->reply ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        @foreach (['unread', 'read', 'replied', 'archived', 'spam'] as $s)
                            <option value="{{ $s }}" {{ $item->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
