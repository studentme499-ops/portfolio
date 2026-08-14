@extends('layouts.app')

@section('title', 'About — Amiri Bajuun')

@section('content')

<div class="container" style="padding: 80px 0;">
    <span class="badge">ABOUT ME</span>
    <h1 style="font-size: 38px; margin-bottom: 20px;">Passionate About Building Great Software</h1>
    <p style="color: var(--text-muted); max-width: 600px; margin-bottom: 40px;">
        Amiri Bajuun is a full stack developer with over 5+ years of experience
        building scalable web applications. Specializing in Laravel, React, Next.js,
        and modern cloud architecture.
    </p>

    <h3 style="margin-bottom: 20px;">Core Engineering Capabilities</h3>
    <div style="display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
        <div class="card">
            <strong style="color: var(--accent-hover);">Frontend</strong>
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 8px;">React, Next.js, Vue.js, Tailwind CSS</p>
        </div>
        <div class="card">
            <strong style="color: var(--accent-hover);">Backend</strong>
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 8px;">Laravel, Node.js, Express, Python</p>
        </div>
        <div class="card">
            <strong style="color: var(--accent-hover);">Database</strong>
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 8px;">MySQL, PostgreSQL, Redis, MongoDB</p>
        </div>
        <div class="card">
            <strong style="color: var(--accent-hover);">DevOps</strong>
            <p style="font-size: 12px; color: var(--text-muted); margin-top: 8px;">AWS, Docker, Nginx, CI/CD</p>
        </div>
    </div>
</div>

@endsection
