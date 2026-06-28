@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Modifier la commande #{{ $order->id }}</h2>
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ $order->status }}" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" id="total" class="form-control" value="{{ $order->total }}" required>
        </div>
        <div class="mb-3">
            <label for="products" class="form-label">Produits</label>
            <select name="products[]" id="products" class="form-control" multiple>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" 
                        @if($order->products->contains($product->id)) selected @endif>
                        {{ $product->name }} - {{ $product->price }} MAD
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
    </form>
</div>
@endsection
