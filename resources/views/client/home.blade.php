@extends('layouts.app')

@section('content')
<div class="container mt-6">

    <!-- Résumé du compte -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mt-10">
        <h4 class="font-bold mb-4 text-blue-600">📊 Résumé de votre compte</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
            <div class="p-4 bg-blue-50 dark:bg-gray-700 rounded-lg shadow">
                <i class="fas fa-shopping-cart text-blue-600 text-2xl mb-2"></i>
                <p class="text-2xl font-bold text-blue-600">{{ $orders->count() }}</p>
                <p class="text-sm text-gray-500">Commandes</p>
            </div>
            <div class="p-4 bg-green-50 dark:bg-gray-700 rounded-lg shadow">
                <i class="fas fa-store text-green-600 text-2xl mb-2"></i>
                <p class="text-2xl font-bold text-green-600">{{ $shops->count() }}</p>
                <p class="text-sm text-gray-500">Boutiques suivies</p>
            </div>
        </div>    
    </div>

    <!-- Mini-dashboard -->
    <div class="grid md:grid-cols-3 gap-6 mt-10">
        <!-- Derniers produits -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h4 class="font-bold mb-3 text-blue-600">🆕 Derniers produits</h4>
            <ul class="space-y-2">
                @foreach($products->take(5) as $product)
                    <li class="flex justify-between text-sm">
                        <span>{{ $product->name }}</span>
                        <span class="text-green-600">{{ $product->price }} MAD</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Boutiques récentes -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h4 class="font-bold mb-3 text-pink-600">🏪 Boutiques récentes</h4>
            <ul class="space-y-2">
                @foreach($shops->take(5) as $shop)
                    <li class="flex items-center text-sm">
                        <i class="fas fa-store text-blue-500 mr-2"></i> {{ $shop->name }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Dernières commandes -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
            <h4 class="font-bold mb-3 text-green-600">📜 Vos dernières commandes</h4>
            <ul class="space-y-2">
                @foreach($orders->take(5) as $order)
                    <li class="flex items-center text-sm">
                        <i class="fas fa-receipt text-green-500 mr-2"></i> Commande #{{ $order->id }} - 
                        @if($order->status === 'en cours')
                            <span class="badge bg-warning text-dark">En cours</span>
                        @elseif($order->status === 'livrée')
                            <span class="badge bg-success">Livrée</span>
                        @elseif($order->status === 'annulée')
                            <span class="badge bg-danger">Annulée</span>
                        @else
                            <span class="badge bg-secondary">{{ $order->status }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Navigation rapide -->
    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow mt-10 mb-10">
        <h3 class="text-lg font-bold mb-4 text-blue-600">⚡ Navigation rapide</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('client.home') }}" class="flex items-center justify-center bg-white dark:bg-gray-800 p-3 rounded shadow hover:scale-105 transition">
                <i class="fas fa-home text-blue-500 mr-2"></i> Accueil
            </a>
            <a href="{{ route('client.products.index') }}" class="flex items-center justify-center bg-white dark:bg-gray-800 p-3 rounded shadow hover:scale-105 transition">
                <i class="fas fa-box text-green-500 mr-2"></i> Produits
            </a>
            <a href="{{ route('client.shops.index') }}" class="flex items-center justify-center bg-white dark:bg-gray-800 p-3 rounded shadow hover:scale-105 transition">
                <i class="fas fa-store text-pink-500 mr-2"></i> Boutiques
            </a>
            <a href="{{ route('client.cart.index') }}" class="flex items-center justify-center bg-white dark:bg-gray-800 p-3 rounded shadow hover:scale-105 transition">
                <i class="fas fa-shopping-cart text-orange-500 mr-2"></i> Panier
            </a>
        </div>
    </div>

    <!-- Fil d’actualités produits -->
    <div id="client-feed" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products->take(45) as $product)
        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md transform hover:scale-105 hover:shadow-xl transition duration-300 ease-in-out">
            <a href="{{ route('client.products.show', $product->id) }}" class="block">
                <img src="https://picsum.photos/400/200?random={{ $product->id }}" 
                    alt="{{ $product->name }}" 
                    class="w-full h-48 object-cover rounded mb-3">
            </a>
            <h5 class="font-bold text-lg text-gray-800 dark:text-gray-200">{{ $product->name }}</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($product->description, 80) }}</p>
            <span class="text-green-600 font-semibold block mb-3">{{ $product->price }} MAD</span>

            <!-- Formulaire quantité + ajout au panier -->
            @if($product->stock > 0)
                <form action="{{ route('client.cart.store') }}" method="POST" class="flex items-center space-x-2 mt-3">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                        class="w-20 border rounded px-2 py-1 focus:ring focus:ring-blue-300">
                    <button type="submit" 
                            class="flex-1 bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition flex items-center justify-center">
                        <i class="fas fa-cart-plus mr-2"></i> Ajouter
                    </button>
                </form>
            @else
                <p class="mt-3 text-red-500 font-semibold">Produit indisponible</p>
            @endif
        </div>
        @endforeach
    </div>

</div>
@endsection
