<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tailoring Shop Management System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header class="site-header">
    <div class="nav-inner">
        <a class="brand" href="{{ route('dashboard') }}">
            <span class="brand-mark">T</span>
            <span>TailorDesk</span>
        </a>
        <button class="menu-btn" type="button" aria-controls="primary-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span></span><span></span><span></span>
        </button>
        <nav class="primary-nav" id="primary-nav" aria-label="Main navigation">
            @include('layouts._nav')
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="page-content {{ request()->routeIs('dashboard') ? 'dashboard-page' : '' }}">
        <div class="page-title">
            <span class="eyebrow">TAILORDESK · SHOP MANAGEMENT</span>
            <h1>@yield('page-title', 'Dashboard')</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                <span class="fw-bold me-2">✓</span>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible d-flex align-items-start" role="alert">
                <span class="fw-bold me-2">!</span>
                <div>
                    <strong>Please review the form.</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer>TailorDesk <span>·</span> Customers, employees, clothing orders, measurements and payments</footer>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    const menuButton = document.querySelector('.menu-btn');
    const primaryNav = document.querySelector('#primary-nav');

    menuButton.addEventListener('click', () => {
        const isOpen = primaryNav.classList.toggle('open');
        menuButton.setAttribute('aria-expanded', String(isOpen));
    });
</script>
@stack('scripts')
</body>
</html>
