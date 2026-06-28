@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Mes Boutiques</h2>
    <a href="{{ route('vendeur.shops.create') }}" class="btn btn-primary mb-3">➕ Ajouter une boutique</a>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shops as $shop)
                <tr>
                    <td>{{ $shop->name }}</td>
                    <td>{{ $shop->description }}</td>
                    <td>{{ $shop->address }}</td>
                    <td>
                        <a href="{{ route('vendeur.shops.show', $shop->id) }}" class="btn btn-info btn-sm">👁️ Voir</a>
                        <a href="{{ route('vendeur.shops.edit', $shop->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                        <form action="{{ route('vendeur.shops.destroy', $shop->id) }}" method="POST" class="d-inline">
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
