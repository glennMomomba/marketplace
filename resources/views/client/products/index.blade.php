@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Catalogue des Produits</h2>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>{{ $product->name }}</h5>
                        <p>{{ $product->price }} MAD</p>
                        <a href="{{ route('client.products.show', $product->id) }}" class="btn btn-info btn-sm">👁️ Voir</a>
                        <form action="{{ route('client.cart.store') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="btn btn-success btn-sm">🛒 Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
