<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPD Gestion Scolaire</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .navbar-brand { letter-spacing: 1px; }
        .nav-link { transition: all 0.3s; margin-right: 10px; }
        .nav-link:hover { transform: translateY(-2px); }
        .navbar-dark .navbar-nav .nav-link.active { color: #fff; border-bottom: 2px solid #fff; }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i> IPD GESTION
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('dashboard*') ? 'active fw-bold' : '' }}" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line me-1"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('etudiants*') ? 'active fw-bold' : '' }}" href="{{ route('etudiants.index') }}">
                            <i class="fas fa-user-graduate me-1"></i> Étudiants
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('filieres*') ? 'active fw-bold' : '' }}" href="{{ route('filieres.index') }}">
                            <i class="fas fa-layer-group me-1"></i> Filières
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('cours*') ? 'active fw-bold' : '' }}" href="{{ route('cours.index') }}">
                            <i class="fas fa-book me-1"></i> Cours
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> <strong>Oups !</strong> Veuillez vérifier le formulaire.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <main class="py-2">
        @yield('content')
    </main>

    <footer class="text-center py-4 mt-5 text-muted small">
        &copy; {{ date('Y') }} IPD Gestion Scolaire - Application de Test
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>