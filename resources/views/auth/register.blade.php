@extends('layouts.guest')

@section('content')
<div class="container mx-auto max-w-md mt-12 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center text-green-600 mb-6">📝 Inscription</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('client.home') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium">Nom complet</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Mot de passe</label>
            <input id="password" type="password" name="password" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-green-300">
        </div>

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">
            Créer un compte
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
        Déjà inscrit ? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Se connecter</a>
    </p>
</div>
@endsection
