@extends('layouts.app')

@section('title', 'Services — Amiri Bajuun')

@section('content')

<div class="container" style="padding: 70px 0;">
    <span class="badge">SERVICES</span>
    <h1 style="font-size: 36px;">What I Can Build For You</h1>

    <div class="service-grid">
        <div class="service-card">
            <div class="service-icon">⚡</div>
            <h3>Web Development</h3>
            <p style="font-size: 12px; color: var(--text-muted);">Custom web applications built with modern frameworks and fluid UX.</p>
            <ul>
                <li>Single Page Applications</li>
                <li>E-Commerce Systems</li>
            </ul>
        </div>
        <div class="service-card">
            <div class="service-icon">📱</div>
            <h3>Mobile App Development</h3>
            <p style="font-size: 12px; color: var(--text-muted);">Cross-platform mobile solutions for iOS and Android.</p>
            <ul>
                <li>React Native Apps</li>
                <li>Flutter Engineering</li>
            </ul>
        </div>
        <div class="service-card">
            <div class="service-icon">⚙️</div>
            <h3>API Development</h3>
            <p style="font-size: 12px; color: var(--text-muted);">RESTful and GraphQL architecture designed for rapid data throughput.</p>
            <ul>
                <li>Microservices</li>
                <li>Third-party Integrations</li>
            </ul>
        </div>
    </div>
</div>

@endsection
