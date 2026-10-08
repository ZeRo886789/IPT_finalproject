<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>@yield('title', 'Basketball League Management')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <div class="navbar-nav mx-auto">
                <a class="nav-link" href="{{ route('coaches.index') }}">Coaches</a>
                <a class="nav-link" href="{{ route('teams.index') }}">Teams</a>
                <a class="nav-link" href="{{ route('players.index') }}">Players</a>
                <a class="nav-link" href="{{ route('games.index') }}">Games</a>
                <a class="nav-link" href="{{ route('scores.index') }}">Scores</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="bg-dark text-light pt-5 pb-4 mt-5">
        <div class="container text-center text-md-start">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold text-warning mb-4">Company Name</h5>
                    <p>
                        Building outstanding web applications with modern design systems. We focus on clean code, speed, and exceptional user experiences.
                    </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Products</h5>
                    <p><a href="#" class="text-reset text-decoration-none">Web Design</a></p>
                    <p><a href="#" class="text-reset text-decoration-none">Development</a></p>
                    <p><a href="#" class="text-reset text-decoration-none">SEO Marketing</a></p>
                    <p><a href="#" class="text-reset text-decoration-none">Cloud Hosting</a></p>
                </div>
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Useful Links</h5>
                    <p><a href="#" class="text-reset text-decoration-none">Your Account</a></p>
                    <p><a href="#" class="text-reset text-decoration-none">Affiliate Program</a></p>
                    <p><a href="#" class="text-reset text-decoration-none">Shipping Rates</a></p>
                    <p><a href="#" class="text-reset text-decoration-none">Help Support</a></p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Contact</h5>
                    <p><i class="bi bi-house-door-fill me-3 text-secondary"></i> New York, NY 10012, US</p>
                    <p><i class="bi bi-envelope-fill me-3 text-secondary"></i> info@example.com</p>
                    <p><i class="bi bi-telephone-fill me-3 text-secondary"></i> + 01 234 567 88</p>
                    <p><i class="bi bi-printer-fill me-3 text-secondary"></i> + 01 234 567 89</p>
                </div>
            </div>
        </div>
        <div class="text-center p-3 border-top border-secondary">
            <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <span class="text-secondary small">
                    &copy; 2026 Company Name. All rights reserved.
                </span>
                <div class="mt-2 mt-sm-0">
                    <a href="#" class="text-reset me-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-reset me-4"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-reset me-4"><i class="bi bi-google"></i></a>
                    <a href="#" class="text-reset"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
