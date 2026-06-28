@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-primary">🛒 Mon panier</h2>

    @if($cartItems->isEmpty())
        <p class="text-muted">Votre panier est vide.</p>
    @else
        <ul class="list-group mt-3">
            @foreach($cartItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $item->name }}</strong><br>
                        Prix : {{ $item->price }} €<br>
                        Quantité : {{ $item->pivot->quantity }}
                    </div>
                    <div>
                        <!-- Formulaire pour mise à jour -->
                        <form action="{{ route('client.cart.update', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="number" name="quantity" value="{{ $item->pivot->quantity }}" min="1" class="form-control d-inline w-25">
                            <button class="btn btn-sm btn-warning">Mettre à jour</button>
                        </form>

                        <!-- Formulaire pour suppression -->
                        <form action="{{ route('client.cart.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Retirer</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-3">
            <form action="{{ route('client.cart.checkout') }}" method="POST">
                @csrf
                <button class="btn btn-success">Valider la commande</button>
            </form>
        </div>
    @endif
</div>
@endsection
