<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Marketplace - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" href="{{ route('admin.dashboard') }}">⚙️ Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">📦 Produits</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}">📂 Catégories</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders.index') }}">📜 Commandes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">👤 Profil</a></li>
                        <li class="nav-item">
                            <form method="POST" action="/logout">
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
    <div class="offcanvas offcanvas-start bg-black text-light" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-warning">Navigation rapide</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-black text-light"><a href="{{ route('admin.products.index') }}" class="text-light">📦 Produits</a></li>
                <li class="list-group-item bg-black text-light"><a href="{{ route('admin.categories.index') }}" class="text-light">📂 Catégories</a></li>
                <li class="list-group-item bg-black text-light"><a href="{{ route('admin.orders.index') }}" class="text-light">📜 Commandes</a></li>
            </ul>
        </div>
    </div>

    <!-- Contenu principal -->
    <main class="container-fluid flex-grow-1 mt-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-center py-3 border-top border-secondary mt-auto">
        <p class="mb-0 text-light">© 2026 Marketplace | Tous droits réservés</p>
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