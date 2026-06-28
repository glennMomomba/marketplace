@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Passer une commande</h2>
    <form action="{{ route('client.orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="address" class="form-label">Adresse de livraison</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Méthode de paiement</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="cash">Paiement à la livraison</option>
                <option value="card">Carte bancaire</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">✅ Confirmer la commande</button>
    </form>
</div>
@endsection
