@extends('layouts.app')

@section('title', 'Amiri Bajuun — Full Stack Developer')

@section('content')

<!-- =========================
     HERO SECTION
========================= -->

<section class="hero container">

    <div class="hero-content">

        <span class="badge">FULL STACK DEVELOPER</span>

        <h1>
            Building Digital Experiences With Clean Code &amp; Modern Tech
        </h1>

        <p class="hero-lead">
            Senior full stack developer specializing in building scalable
            web applications, API architectures, and cloud deployments.
        </p>

        <a href="{{ route('projects') }}" class="btn-primary">
            View My Work
        </a>

    </div>


    <!-- CODE BOX -->

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


<!-- =========================
     PROJECTS SECTION
========================= -->

<section class="section projects-section">

    <div class="projects-container">

        <!-- CENTERED SECTION HEADER -->

        <div class="projects-header">

            <span class="badge">
                PROVEN TRACK RECORD
            </span>

            <h2>
                Selected Projects
            </h2>

        </div>


        <!-- PROJECT CARDS -->

        <div class="grid-3">

            <!-- PROJECT 1 -->

            <div class="card">

                <span class="card-label">
                    WEB APP &bull; 2024
                </span>

                <h3>
                    Sokoni Marketplace
                </h3>

                <p>
                    Full-stack e-commerce marketplace with real-time
                    inventory management.
                </p>

            </div>


            <!-- PROJECT 2 -->

            <div class="card">

                <span class="card-label">
                    HEALTHCARE APP &bull; 2024
                </span>

                <h3>
                    HealthTrack Pro
                </h3>

                <p>
                    Patient management system with HIPAA-compliant
                    records.
                </p>

            </div>


            <!-- PROJECT 3 -->

            <div class="card">

                <span class="card-label">
                    DEVELOPER TOOL &bull; 2023
                </span>

                <h3>
                    DevFlow CI/CD
                </h3>

                <p>
                    Continuous integration platform with automated
                    testing flows.
                </p>

            </div>

        </div>

    </div>

</section>

@endsection