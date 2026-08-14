@extends('layouts.admin')

@section('title', 'SEO & Global Settings — Amiri CMS')

@section('content')

<div class="container admin-container">
    <div style="display: flex; justify-content: space-between; margin-bottom: 24px;">
        <h2>Settings &amp; SEO Configuration</h2>
        <button class="btn-primary">Save Settings</button>
    </div>

    <div style="background: var(--bg-card); border: 1px solid var(--border); padding: 24px; border-radius: 8px; margin-bottom: 20px;">
        <h3 style="font-size: 14px; margin-bottom: 16px;">Global Meta Tags</h3>
        <div style="display: grid; gap: 14px;">
            <div>
                <label style="font-size: 10px; color: var(--text-muted);">DEFAULT SITE TITLE</label>
                <input type="text" value="Amiri Bajuun | Software Engineer" style="width:100%; background:#000; border:1px solid var(--border); padding:8px; border-radius:4px; color:#fff; font-size:12px; margin-top:4px;">
            </div>
            <div>
                <label style="font-size: 10px; color: var(--text-muted);">GOOGLE ANALYTICS ID</label>
                <input type="text" value="G-47YHD892" style="width:100%; background:#000; border:1px solid var(--border); padding:8px; border-radius:4px; color:#fff; font-size:12px; margin-top:4px;">
            </div>
        </div>
    </div>

    <div style="background: var(--bg-card); border: 1px solid var(--border); padding: 24px; border-radius: 8px;">
        <h3 style="font-size: 14px; margin-bottom: 16px;">Contact Details</h3>
        <div style="display: grid; gap: 14px;">
            <div>
                <label style="font-size: 10px; color: var(--text-muted);">CONTACT EMAIL</label>
                <input type="text" value="hello@amiribajuun.dev" style="width:100%; background:#000; border:1px solid var(--border); padding:8px; border-radius:4px; color:#fff; font-size:12px; margin-top:4px;">
            </div>
            <div>
                <label style="font-size: 10px; color: var(--text-muted);">SOCIAL LINKS</label>
                <input type="text" value="github.com/amiribajuun" style="width:100%; background:#000; border:1px solid var(--border); padding:8px; border-radius:4px; color:#fff; font-size:12px; margin-top:4px;">
            </div>
        </div>
    </div>
</div>

@endsection
