<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteSecure - Online Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-check-square-fill text-primary fs-4 me-2"></i>
                <span class="fw-bold">VoteSecure</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-bar-chart-fill me-1"></i> Live Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-people-fill me-1"></i> Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-info-circle-fill me-1"></i> How to Vote</a>
                    </li>
                </ul>
                <button class="btn btn-primary">Login to Vote</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="container">
            <div class="row min-vh-75 align-items-center">
                <div class="col-lg-6 py-5">
                    <h1 class="display-4 fw-bold mb-3">
                        Your Voice Matters in
                        <span class="text-primary">Shaping Our Future</span>
                    </h1>
                    <p class="lead text-muted mb-4">
                        Participate in the 2024 Elections securely and conveniently. Every vote counts in building a better tomorrow.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <button class="btn btn-primary btn-lg px-4">Start Voting</button>
                        <button class="btn btn-outline-primary btn-lg px-4">View Candidates</button>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://images.unsplash.com/photo-1540910419892-4a36d2c3266c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                         class="hero-image" alt="Voting">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h6 class="text-primary text-uppercase fw-bold">Features</h6>
                <h2 class="display-5 fw-bold mb-3">A Better Way to Vote</h2>
                <p class="lead text-muted mx-auto" style="max-width: 600px;">
                    Our secure electronic voting system ensures your vote is counted accurately and safely.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <div class="feature-icon bg-primary text-white mb-4">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Secure Voting</h4>
                        <p class="text-muted">End-to-end encryption ensures your vote remains confidential and tamper-proof.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <div class="feature-icon bg-primary text-white mb-4">
                            <i class="bi bi-clock"></i>
                        </div>
                        <h4>Real-time Results</h4>
                        <p class="text-muted">Watch election results unfold in real-time with our advanced tracking system.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4">
                        <div class="feature-icon bg-primary text-white mb-4">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h4>Easy Verification</h4>
                        <p class="text-muted">Verify your vote was correctly recorded with our transparent audit system.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>