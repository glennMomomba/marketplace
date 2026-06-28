@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier la commande #{{ $order->id }}</h2>
    <form action="{{ route('client.orders.update', $order->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="address" class="form-label">Adresse de livraison</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $order->address }}" required>
        </div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Méthode de paiement</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="cash" @selected($order->payment_method == 'cash')>Paiement à la livraison</option>
                <option value="card" @selected($order->payment_method == 'card')>Carte bancaire</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
    </form>
</div>
@endsection
