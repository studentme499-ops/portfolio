@extends('layouts.app')

@section('title', $project['title'] . ' — Case Study')

@section('content')

<div class="container" style="padding: 60px 0;">
    <span class="badge">{{ strtoupper($project['category']) }}</span>
    <h1 style="font-size: 42px; margin: 10px 0 30px;">{{ $project['title'] }}</h1>

    <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: 12px; height: 320px; display: flex; align-items: center; justify-content: center; margin-bottom: 40px; color: var(--text-muted);">
        [ Full Interactive Showcase / Image Dashboard Banner ]
    </div>

    <div style="display: grid; gap: 40px; grid-template-columns: 2fr 1fr;">
        <div>
            <h3>Project Overview</h3>
            <p style="color: var(--text-muted); font-size: 14px; margin: 12px 0 24px;">
                {{ $project['overview'] }}
            </p>
            <h3>The Challenge</h3>
            <p style="color: var(--text-muted); font-size: 14px; margin: 12px 0 24px;">
                {{ $project['challenge'] }}
            </p>
        </div>
        <div class="card" style="height: fit-content;">
            <div style="margin-bottom: 12px;"><strong>Client:</strong> {{ $project['client'] }}</div>
            <div style="margin-bottom: 12px;"><strong>Role:</strong> {{ $project['role'] }}</div>
            <div style="margin-bottom: 12px;"><strong>Duration:</strong> {{ $project['duration'] }}</div>
            <div><strong>Status:</strong> <span style="color: var(--success);">{{ $project['status'] }}</span></div>
        </div>
    </div>
</div>

@endsection
