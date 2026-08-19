@extends('layouts.admin')

@section('title', 'Analytics — Amiri CMS')

@section('content')

<div class="page-header">
    <h1>Analytics</h1>
    <span class="btn btn-sm" style="cursor: default;">Last 30 days</span>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="label">Total Views</div>
        <div class="value">{{ number_format($totals['visitors']) }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Unique Visitors</div>
        <div class="value">{{ number_format($totals['unique']) }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Pages Viewed</div>
        <div class="value">{{ number_format($totals['page_views']) }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Conversions</div>
        <div class="value">{{ number_format($totals['conversions']) }}</div>
    </div>
</div>

<div class="panel">
    <div class="panel-header"><h3>Traffic — Last 30 Days</h3></div>
    <div class="panel-body">
        <div style="width: 100%; overflow-x: auto;">
            <div style="display: flex; align-items: flex-end; gap: 4px; height: 140px; min-width: 600px;">
                @foreach ($series as $i => $count)
                    <div style="flex: 1; text-align: center;" title="{{ $count }} views">
                        <div style="font-size: 9px; color: var(--text-muted); margin-bottom: 4px;">{{ $count }}</div>
                        <div style="background: var(--accent); border-radius: 3px 3px 0 0; height: {{ $count / $max * 100 }}px; min-height: {{ $count > 0 ? 3 : 1 }}px;"></div>
                        <div style="font-size: 9px; color: var(--text-muted); margin-top: 4px;">{{ $days[$i] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 16px; align-items: start;">
    <div class="panel">
        <div class="panel-header"><h3>Devices</h3></div>
        <div class="panel-body">
            <div class="list-stack">
                @forelse ($devices as $device => $count)
                    <div class="item">
                        <div>
                            <strong style="text-transform: capitalize; font-size: 13px;">{{ $device }}</strong>
                            <div style="font-size: 11px; color: var(--text-muted);">{{ $count }} views</div>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-size: 12px; text-align: center;">No data</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Browsers</h3></div>
        <div class="panel-body">
            <div class="list-stack">
                @forelse ($browsers as $browser => $count)
                    <div class="item">
                        <div>
                            <strong style="font-size: 13px;">{{ $browser }}</strong>
                            <div style="font-size: 11px; color: var(--text-muted);">{{ $count }} views</div>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-size: 12px; text-align: center;">No data</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Locations</h3></div>
        <div class="panel-body">
            <div class="list-stack">
                @forelse ($countries as $country => $count)
                    <div class="item">
                        <div>
                            <strong style="font-size: 13px;">{{ $country }}</strong>
                            <div style="font-size: 11px; color: var(--text-muted);">{{ $count }} views</div>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-size: 12px; text-align: center;">No data</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header"><h3>Top Pages</h3></div>
        <div class="panel-body">
            <div class="list-stack">
                @forelse ($topPaths as $path => $count)
                    <div class="item">
                        <div>
                            <code style="font-size: 12px;">{{ $path }}</code>
                            <div style="font-size: 11px; color: var(--text-muted);">{{ $count }} views</div>
                        </div>
                    </div>
                @empty
                    <p style="color: var(--text-muted); font-size: 12px; text-align: center;">No data</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection