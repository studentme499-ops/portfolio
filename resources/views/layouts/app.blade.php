<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Amiri Bajuun — Full Stack Developer')</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <header class="site-header">
        <div class="container nav-wrap">
            <a href="{{ route('home') }}" class="brand">AMIRI BAJUUN</a>

            <nav class="nav-links">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
                <a href="{{ route('projects') }}" class="{{ request()->routeIs('projects') || request()->routeIs('project.detail') ? 'active' : '' }}">Projects</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </nav>

            <a href="{{ route('contact') }}" class="btn-primary">Let's Talk</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-wrap">
            <div>&copy; {{ date('Y') }} Amiri Bajuun. All rights reserved.</div>
            <div class="socials">
                <span>in</span>
                <span>Git</span>
                <span>◎</span>
                <span>𝕏</span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/portfolio.js') }}" defer></script>
</body>
</html>
