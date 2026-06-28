@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Détails de la commande #{{ $order->id }}</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Client :</strong> {{ $order->user->name }}</p>
            <p><strong>Email :</strong> {{ $order->user->email }}</p>
            <p><strong>Total :</strong> {{ $order->total }} MAD</p>
            <p><strong>Statut :</strong> {{ $order->status }}</p>
            <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

            <h4>Produits :</h4>
            <ul>
                @foreach($order->products as $product)
                    <li>{{ $product->name }} - {{ $product->pivot->quantity }} x {{ $product->price }} MAD</li>
                @endforeach
            </ul>

            <a href="{{ route('vendeur.orders.index') }}" class="btn btn-secondary">⬅️ Retour</a>
        </div>
    </div>
</div>
@endsection
