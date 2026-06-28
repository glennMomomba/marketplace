@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Modifier la commande #{{ $order->id }}</h2>
    <form action="{{ route('vendeur.orders.update', $order->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $order->status }}" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ $order->total }}" required>
        </div>
        <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
    </form>
</div>
@endsection
