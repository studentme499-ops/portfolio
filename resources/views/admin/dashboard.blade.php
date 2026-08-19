@extends('layouts.admin')

@section('title', 'Dashboard — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Dashboard</h1>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ New Project</a>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="label">Total Projects</div>
        <div class="value">{{ $totalProjects }}</div>
        <div class="delta up">{{ $publishedProjects }} published</div>
    </div>
    <div class="stat-card">
        <div class="label">Total Services</div>
        <div class="value">{{ $totalServices }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Total Clients</div>
        <div class="value">{{ $totalClients }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Total Experience</div>
        <div class="value">{{ $totalExperience }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Messages</div>
        <div class="value">{{ $totalMessages }}</div>
        <div class="delta {{ $unreadMessages > 0 ? 'down' : 'up' }}">{{ $unreadMessages }} unread</div>
    </div>
    <div class="stat-card">
        <div class="label">Skills / Technologies</div>
        <div class="value">{{ $totalSkills }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Website Views</div>
        <div class="value">{{ number_format($totalVisitors) }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Blog Posts</div>
        <div class="value">{{ $totalBlogPosts }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; align-items: start;">
    <div>
        <div class="panel">
            <div class="panel-header">
                <h3>Recent Projects</h3>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm">View All</a>
            </div>
            <div class="panel-body" style="padding: 0;">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr><th>Name</th><th>Category</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            @forelse ($recentProjects as $p)
                                <tr>
                                    <td><strong>{{ $p->name }}</strong></td>
                                    <td>{{ $p->category ?? '—' }}</td>
                                    <td><span class="badge {{ $p->status === 'published' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($p->status) }}</span></td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="empty-state">No projects yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header"><h3>Visitors (Last 7 Days)</h3></div>
            <div class="panel-body">
                @if ($visitsByDay->count())
                    <div style="display: flex; align-items: flex-end; gap: 8px; height: 120px;">
                        @php $max = max(1, $visitsByDay->max()); @endphp
                        @foreach ($visitsByDay as $day => $count)
                            <div style="flex: 1; text-align: center;">
                                <div style="font-size: 10px; color: var(--text-muted); margin-bottom: 4px;">{{ $count }}</div>
                                <div style="background: var(--accent); border-radius: 4px 4px 0 0; height: {{ $count / $max * 100 }}px; min-height: 4px;"></div>
                                <div style="font-size: 9px; color: var(--text-muted); margin-top: 4px;">{{ \Illuminate\Support\Carbon::parse($day)->format('D') }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--text-muted); font-size: 12px; text-align: center; padding: 20px;">No visitor data yet.</p>
                @endif
            </div>
        </div>
    </div>

    <div>
        <div class="panel">
            <div class="panel-header">
                <h3>Recent Messages</h3>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-sm">View All</a>
            </div>
            <div class="panel-body">
                <div class="list-stack">
                    @forelse ($recentMessages as $m)
                        <a href="{{ route('admin.messages.show', $m) }}" class="item" style="text-decoration: none;">
                            <div>
                                <strong style="font-size: 13px;">{{ $m->name }}</strong>
                                <div style="font-size: 11px; color: var(--text-muted);">{{ $m->subject ?? 'No subject' }}</div>
                            </div>
                            @if ($m->status === 'unread')
                                <span class="badge badge-danger">New</span>
                            @endif
                        </a>
                    @empty
                        <p style="color: var(--text-muted); font-size: 12px; text-align: center; padding: 10px;">No messages.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header"><h3>Quick Actions</h3></div>
            <div class="panel-body" style="display: grid; gap: 8px;">
                <a href="{{ route('admin.projects.create') }}" class="btn">+ New Project</a>
                <a href="{{ route('admin.blog.create') }}" class="btn">✉ New Blog Post</a>
                <a href="{{ route('admin.media.create') }}" class="btn">▰ Upload Media</a>
                <a href="{{ route('admin.resume.index') }}" class="btn">▥ Manage CV</a>
                <a href="{{ route('admin.settings') }}" class="btn">⚙ Site Settings</a>
            </div>
        </div>
    </div>
</div>

@endsection
