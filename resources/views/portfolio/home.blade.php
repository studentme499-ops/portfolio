@extends('layouts.app')

@section('title', 'Amiri Bajuun — Full Stack Developer')

@section('content')

<section class="hero container">
    <div>
        <span class="badge">FULL STACK DEVELOPER</span>
        <h1>Building Digital Experiences With Clean Code &amp; Modern Tech</h1>
        <p class="hero-lead">
            Senior full stack developer specializing in building scalable
            web applications, API architectures, and cloud deployments.
        </p>
        <a href="{{ route('projects') }}" class="btn-primary">View My Work</a>
    </div>

    <div class="code-box">
<pre>
import { Sokoni, HealthTrack } from 'amiri-bajuun';

const developer = {
  name: 'Amiri Bajuun',
  core: ['Laravel', 'React', 'Vue', 'Next.js']
};

function buildSystem() {
  return pipeline
    .optimizePerformance()
    .secureByDesign();
}
</pre>
    </div>
</section>

<section class="section container">
    <span class="badge">PROVEN TRACK RECORD</span>
    <h2 style="font-size: 28px;">Selected Projects</h2>
    <div class="grid-3">
        <div class="card">
            <span class="card-label">WEB APP &bull; 2024</span>
            <h3>Sokoni Marketplace</h3>
            <p>Full-stack e-commerce marketplace with real-time inventory management.</p>
        </div>
        <div class="card">
            <span class="card-label">HEALTHCARE APP &bull; 2024</span>
            <h3>HealthTrack Pro</h3>
            <p>Patient management system with HIPAA-compliant records.</p>
        </div>
        <div class="card">
            <span class="card-label">DEVELOPER TOOL &bull; 2023</span>
            <h3>DevFlow CI/CD</h3>
            <p>Continuous integration platform with automated testing flows.</p>
        </div>
    </div>
</section>

@endsection
