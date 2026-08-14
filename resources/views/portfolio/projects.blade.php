@extends('layouts.app')

@section('title', 'Projects — Amiri Bajuun')

@section('content')

<div class="container" style="padding: 70px 0;">
    <span class="badge">PROVEN TRACK RECORD</span>
    <h1 style="font-size: 36px; margin-bottom: 30px;">Selected Projects</h1>

    <div class="grid-3">
        <a href="{{ route('project.detail', 'sokoni-marketplace') }}" class="card">
            <span class="card-label">WEB APP &bull; 2024</span>
            <h3>Sokoni Marketplace</h3>
            <p>Full-stack e-commerce marketplace with real-time inventory management, multi-currency payments, and vendor dashboards.</p>
        </a>
        <a href="{{ route('project.detail', 'healthtrack-pro') }}" class="card">
            <span class="card-label">HEALTHCARE APP &bull; 2024</span>
            <h3>HealthTrack Pro</h3>
            <p>Patient management system with HIPAA-compliant records and dynamic appointment scheduling.</p>
        </a>
        <a href="{{ route('project.detail', 'devflow-ci-cd') }}" class="card">
            <span class="card-label">DEVELOPER TOOL &bull; 2023</span>
            <h3>DevFlow CI/CD</h3>
            <p>Continuous integration platform with automated testing flows and deployment pipelines.</p>
        </a>
    </div>
</div>

@endsection
