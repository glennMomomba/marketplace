@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Ajouter une boutique</h2>
    <form action="{{ route('vendeur.shops.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse</label>
            <input type="text" name="address" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">✅ Enregistrer</button>
    </form>
</div>
@endsection
