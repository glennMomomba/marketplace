@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Détails du produit</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $product->name }}</h4>
            <p><strong>Prix :</strong> {{ $product->price }} MAD</p>
            <p><strong>Stock :</strong> {{ $product->stock }}</p>
            <p><strong>Description :</strong> {{ $product->description }}</p>
            <a href="{{ route('vendeur.products.index') }}" class="btn btn-secondary">⬅️ Retour</a>
        </div>
    </div>
</div>
@endsection
