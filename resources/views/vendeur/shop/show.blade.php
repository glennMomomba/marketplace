@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Détails de la boutique</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $shop->name }}</h4>
            <p><strong>Description :</strong> {{ $shop->description }}</p>
            <p><strong>Adresse :</strong> {{ $shop->address }}</p>
            <a href="{{ route('vendeur.shops.index') }}" class="btn btn-secondary">⬅️ Retour</a>
        </div>
    </div>
</div>
@endsection
