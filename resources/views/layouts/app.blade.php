<!-- Navbar -->
<nav class="bg-white dark:bg-gray-800 shadow sticky top-0 z-50">
    <div class="flex justify-between items-center h-16 px-6">
        <!-- Logo -->
        <a href="{{ route('client.home') }}" class="text-2xl font-bold text-blue-600">
            Marketplace
        </a>

        <!-- Zone Auth -->
        <div class="flex space-x-4 items-center">
            @guest
                <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 flex items-center">
                    <i class="fas fa-user-plus mr-1"></i> Inscription
                </a>
                <a href="{{ route('login') }}" class="text-green-500 hover:text-green-700 flex items-center">
                    <i class="fas fa-sign-in-alt mr-1"></i> Connexion
                </a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500 hover:text-red-700 flex items-center">
                        <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                    </button>
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Sidebar (desktop) -->
<aside class="hidden md:block fixed top-16 left-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg p-6 overflow-y-auto">
    <h3 class="text-lg font-bold mb-4">Filtres</h3>
    <!-- Exemple avec icônes -->
    <div class="space-y-4">
        <label class="flex items-center">
            <i class="fas fa-tags text-blue-500 mr-2"></i>
            <select name="category" class="w-full border px-3 py-2 rounded">
                <option value="">Toutes les catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </label>
        <!-- autres filtres idem -->
    </div>
</aside>

<!-- Drawer (mobile) -->
<div id="drawer" class="fixed top-0 right-0 h-screen w-64 bg-white dark:bg-gray-800 shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <div class="p-4 border-b dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-lg font-bold text-blue-600">Navigation</h2>
        <button id="close-drawer" class="text-gray-600 dark:text-gray-300 hover:text-red-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <nav class="p-4 space-y-4">
        <a href="{{ route('client.products.index') }}" class="flex items-center text-green-600 hover:text-green-800">
            <i class="fas fa-box mr-2"></i> Produits
        </a>
        <a href="{{ route('client.cart.index') }}" class="flex items-center text-orange-600 hover:text-orange-800">
            <i class="fas fa-shopping-cart mr-2"></i> Panier
        </a>
        <a href="{{ route('profile.edit') }}" class="flex items-center text-purple-600 hover:text-purple-800">
            <i class="fas fa-user mr-2"></i> Profil
        </a>
    </nav>
</div>

<!-- Footer -->
<footer class="bg-white dark:bg-gray-800 text-center py-4 mt-6 shadow">
    <p class="text-gray-600 dark:text-gray-300">© 2026 Marketplace | Tous droits réservés</p>
    <div class="mt-2">
        <a href="#" class="me-2 text-blue-600">🌐 Facebook</a>
        <a href="#" class="me-2 text-green-600">🐦 Twitter</a>
        <a href="#" class="text-pink-600">📸 Instagram</a>
    </div>
</footer>
