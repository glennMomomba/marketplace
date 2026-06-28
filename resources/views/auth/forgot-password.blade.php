@extends('layouts.guest')

@section('content')
<div class="container mx-auto max-w-md mt-12 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">🔒 Mot de passe oublié</h2>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-indigo-300">
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
            Envoyer le lien de réinitialisation
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Retour à la connexion</a>
    </p>
</div>
@endsection
