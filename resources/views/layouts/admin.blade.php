<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard — Amiri CMS')</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <header class="admin-header">
        <div class="container admin-nav">
            <a href="{{ route('admin.dashboard') }}" class="brand">AMIRI CMS</a>

            <nav>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('admin.settings') }}" class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">Settings</a>
                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: 0; color: var(--text-muted); font-size: 12px; cursor: pointer; font-family: inherit;">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
