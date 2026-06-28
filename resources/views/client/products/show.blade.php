@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{ $product->name }}</h2>
    <p><strong>Prix :</strong> {{ $product->price }} MAD</p>
    <p><strong>Description :</strong> {{ $product->description }}</p>

    <form action="{{ route('client.cart.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button class="btn btn-success">🛒 Ajouter au panier</button>
    </form>

    <a href="{{ route('client.products.index') }}" class="btn btn-secondary mt-3">⬅️ Retour</a>
</div>
@endsection
