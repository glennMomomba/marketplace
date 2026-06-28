@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Mes Produits</h2>
    <a href="{{ route('vendeur.products.create') }}" class="btn btn-primary mb-3">➕ Ajouter un produit</a>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} MAD</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('vendeur.products.show', $product->id) }}" class="btn btn-info btn-sm">👁️ Voir</a>
                        <a href="{{ route('vendeur.products.edit', $product->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                        <form action="{{ route('vendeur.products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
