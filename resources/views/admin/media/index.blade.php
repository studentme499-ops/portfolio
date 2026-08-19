@extends('layouts.admin')

@section('title', 'Media Library — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Media Library</h1>
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary">+ Upload</a>
</div>

<div class="panel">
    <div class="panel-body">
        <form method="GET" style="margin-bottom: 16px; display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search files..." class="search-box">
            <select name="collection" class="search-box" style="width: 160px; background: var(--bg-card); border: 1px solid var(--border); color: #fff;">
                <option value="">All Collections</option>
                @foreach ($collections as $c)
                    <option value="{{ $c }}" {{ request('collection') === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                @endforeach
            </select>
            <button class="btn btn-sm" type="submit">Filter</button>
        </form>

        <div class="media-grid">
            @forelse ($items as $item)
                <div class="media-item">
                    <div class="thumb">
                        @if (in_array(strtolower(pathinfo($item->filename, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
                            <img src="{{ asset('storage/'.$item->path) }}" alt="{{ $item->filename }}">
                        @else
                            📄
                        @endif
                    </div>
                    <div class="meta">
                        <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $item->filename }}</div>
                        <div>{{ $item->size }} · {{ $item->collection }}</div>
                        <div style="display: flex; gap: 6px; margin-top: 6px;">
                            <button class="btn btn-sm" onclick="copyUrl('{{ asset('storage/'.$item->path) }}', this)">Copy URL</button>
                            <form method="POST" action="{{ route('admin.media.destroy', $item) }}" onsubmit="return confirm('Delete this file?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <div class="big">▰</div>
                    <p>No files yet. <a href="{{ route('admin.media.create') }}">Upload one</a></p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 16px;">{{ $items->links() }}</div>
    </div>
</div>

<script>
function copyUrl(url, btn) {
    navigator.clipboard.writeText(url).then(() => {
        btn.textContent = 'Copied!';
        setTimeout(() => btn.textContent = 'Copy URL', 1500);
    });
}
</script>

@endsection
