<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Marketplace') }}</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="w-full bg-white dark:bg-gray-800 shadow py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('client.home') }}" class="flex items-center space-x-2 text-xl font-bold text-blue-600">
                <i class="fas fa-store text-blue-600"></i>
                <span>{{ config('app.name', 'Marketplace') }}</span>
            </a>
            <div class="space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600">Connexion</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-200 hover:text-blue-600">Inscription</a>
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
    </header>

    <!-- Contenu principal -->
    <main class="flex-grow px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card Commandes -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-center">
                <i class="fas fa-box-open text-blue-600 text-3xl mb-2"></i>
                <h3 class="text-lg font-bold">Mes Commandes</h3>
                <p class="text-gray-600 dark:text-gray-300">@isset($ordersCount){{ $ordersCount }}@endisset commandes</p>
                <a href="{{ route('client.orders.index') }}" class="text-blue-600 hover:underline">Voir mes commandes</a>
            </div>

            <!-- Card Panier -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-center">
                <i class="fas fa-shopping-cart text-green-600 text-3xl mb-2"></i>
                <h3 class="text-lg font-bold">Mon Panier</h3>
                <p class="text-gray-600 dark:text-gray-300">@isset($cartCount){{ $cartCount }}@endisset articles</p>
                <a href="{{ route('client.cart.index') }}" class="text-green-600 hover:underline">Accéder au panier</a>
            </div>

            <!-- Card Favoris -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 text-center">
                <i class="fas fa-heart text-red-600 text-3xl mb-2"></i>
                <h3 class="text-lg font-bold">Mes Favoris</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ $favoritesCount ?? 0 }} favoris</p>
                <a href="#" class="text-red-600 hover:underline">Voir mes favoris</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 text-center py-4 shadow mt-auto">
        <p class="text-gray-600 dark:text-gray-300">© 2026 Marketplace | Tous droits réservés</p>
        <div class="mt-2">
            <a href="#" class="me-2 text-blue-600">🌐 Facebook</a>
            <a href="#" class="me-2 text-green-600">🐦 Twitter</a>
            <a href="#" class="text-pink-600">📸 Instagram</a>
        </div>
    </footer>
</body>
</html>
