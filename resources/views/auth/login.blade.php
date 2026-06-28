@extends('layouts.guest')

@section('content')
<div class="container mx-auto max-w-md mt-12 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center text-blue-600 mb-6">🔑 Connexion</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium">Mot de passe</label>
            <input id="password" type="password" name="password" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
        </div>

        <div class="flex items-center justify-between mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2"> Se souvenir de moi
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Connexion
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
        Pas encore inscrit ? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Créer un compte</a>
    </p>
</div>
@endsection
