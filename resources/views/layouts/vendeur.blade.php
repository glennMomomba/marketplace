<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Marketplace - Vendeur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" href="{{ route('vendeur.dashboard') }}">🏪 Vendeur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#vendeurSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('vendeur.products.index') }}">📦 Produits</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('vendeur.orders.index') }}">📜 Commandes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">👤 Profil</a></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">🚪 Déconnexion</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start bg-success text-white" tabindex="-1" id="vendeurSidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-warning">Menu Vendeur</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-success text-white"><a href="{{ route('vendeur.products.index') }}" class="text-white">📦 Produits</a></li>
                <li class="list-group-item bg-success text-white"><a href="{{ route('vendeur.orders.index') }}" class="text-white">📜 Commandes</a></li>
                <li class="list-group-item bg-success text-white"><a href="{{ route('profile.edit') }}" class="text-white">👤 Profil</a></li>
            </ul>
        </div>
    </div>

    <!-- Messages flash -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                ❌ {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Contenu principal -->
    <main class="container-fluid flex-grow-1 mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-success text-white text-center py-3 mt-auto shadow-lg">
        <p class="mb-0">© 2026 Marketplace | Tous droits réservés</p>
        <div class="mt-2">
            <a href="#" class="me-2 text-warning">🌐 Facebook</a>
            <a href="#" class="me-2 text-warning">🐦 Twitter</a>
            <a href="#" class="text-warning">📸 Instagram</a>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
