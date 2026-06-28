@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-primary">📄 Détail de la commande #{{ $order->id }}</h2>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Statut :</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Total :</strong> {{ $order->total }} €</p>
            <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <h4 class="mt-4">Produits de la commande</h4>
    <ul class="list-group mt-2">
        @foreach($order->products as $product)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $product->name }}</strong><br>
                    Prix unitaire : {{ $product->price }} €<br>
                    Quantité : {{ $product->pivot->quantity }}
                </div>
                <span class="badge bg-secondary">
                    Sous-total : {{ $product->price * $product->pivot->quantity }} €
                </span>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        <a href="{{ route('client.orders.index') }}" class="btn btn-outline-primary">
            ← Retour à mes commandes
        </a>

        @if($order->status === 'en cours')
            <form action="{{ route('client.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Annuler la commande</button>
            </form>
        @endif
    </div>
</div>
@endsection
