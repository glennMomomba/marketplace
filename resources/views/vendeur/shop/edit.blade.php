@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Modifier la boutique</h2>
    <form action="{{ route('vendeur.shops.update', $shop->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" value="{{ $shop->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $shop->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" name="address" value="{{ $shop->address }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
    </form>
</div>
@endsection
