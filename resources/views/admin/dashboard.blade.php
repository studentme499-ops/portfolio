@extends('layouts.admin')

@section('title', 'Dashboard — Amiri CMS')

@section('content')

<div class="container" style="padding: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2>Dashboard</h2>
        <input type="text" placeholder="Search here..." style="background: var(--bg-card); border: 1px solid var(--border); padding: 8px 14px; border-radius: 6px; color: #fff; font-size: 12px;">
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <span style="font-size:11px; color:var(--text-muted);">Total Projects</span>
            <h2>12</h2>
        </div>
        <div class="stat-card">
            <span style="font-size:11px; color:var(--text-muted);">Total Messages</span>
            <h2>47</h2>
        </div>
        <div class="stat-card">
            <span style="font-size:11px; color:var(--text-muted);">Page Views</span>
            <h2>12.4K</h2>
        </div>
        <div class="stat-card">
            <span style="font-size:11px; color:var(--text-muted);">Active Services</span>
            <h2>7</h2>
        </div>
    </div>

    <div class="table-box">
        <h3 style="font-size: 14px; margin-bottom: 16px;">Recent Projects</h3>
        <table>
            <thead>
                <tr><th>Project Name</th><th>Category</th><th>Status</th></tr>
            </thead>
            <tbody>
                <tr><td>Sokoni Marketplace</td><td>Web App</td><td><span style="color:var(--success);">Published</span></td></tr>
                <tr><td>HealthTrack Pro</td><td>Healthcare</td><td><span style="color:var(--success);">Published</span></td></tr>
                <tr><td>DevFlow CI/CD</td><td>Developer Tool</td><td><span style="color:var(--warning);">Draft</span></td></tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
