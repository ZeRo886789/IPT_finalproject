<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tailoring Shop Management System')</title>
    {{-- Bootstrap 5 (CSS) via CDN — no local build required --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    {{-- Static tailoring theme overlay (served directly, independent of Vite) --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-shell">
    {{-- Desktop sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-mark">TS</div>
            <div>
                <strong>Tailor<span>Desk</span></strong>
                <small>SHOP MANAGEMENT</small>
            </div>
        </div>
        @include('layouts._nav')
        <div class="sidebar-foot">
            <div>✂ Made to fit.</div>
            <div>Every customer, order and payment in one place.</div>
        </div>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <button class="menu-btn" onclick="document.getElementById('sidebar').classList.toggle('open')" aria-label="Toggle navigation">☰</button>
            <div class="topbar-title">
                <div class="eyebrow">TAILORING SHOP MANAGEMENT</div>
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="date">{{ now()->format('D, M d, Y') }}</div>
        </header>

        <div class="page-content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
                    <span class="text-wine fw-bold me-2">✓</span>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible d-flex align-items-start" role="alert">
                    <span class="text-wine fw-bold me-2">!</span>
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

        <footer>TailorDesk · Tailoring Shop Management System <span>•</span> Customers · Employees · Clothing Orders · Measurements · Payments</footer>
    </main>
</div>

{{-- Bootstrap 5 (JS + Popper) via CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
