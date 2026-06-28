@extends('layouts.guest')

@section('content')
<div class="container mx-auto p-6">
    <!-- Hero Section -->
    <div class="flex flex-col md:flex-row items-center justify-between py-12 bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600 text-white rounded-lg shadow mb-12">
        <div class="text-center md:text-left md:w-1/2">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Bienvenue sur Marketplace</h1>
            <p class="text-lg mb-6">Achetez, vendez et découvrez les meilleurs produits</p>
            <div class="space-x-4">
                <a href="{{ route('client.products.index') }}" class="bg-white text-blue-600 px-6 py-2 rounded shadow hover:bg-gray-100 transition">Découvrir les produits</a>
                <a href="{{ route('register') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded shadow hover:bg-yellow-500 transition">S’inscrire gratuitement</a>
            </div>
        </div>
        <div class="hidden md:block md:w-1/2">
            <img src="https://picsum.photos/500/300" alt="Marketplace illustration" class="rounded-lg shadow-lg">
        </div>
    </div>
    <!-- ... reste du contenu ... -->
</div>
@endsection
