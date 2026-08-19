<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel') — Amiri CMS</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <div class="admin-body">

        @include('admin.partials.sidebar')

        <div class="main-content">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @yield('content')
        </div>

    </div>

    <script src="{{ asset('js/portfolio.js') }}" defer></script>
</body>
</html>