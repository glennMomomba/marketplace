@extends('layouts.admin')

@section('content')
    <h1>Ajouter un Produit</h1>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="price" class="form-control">
        </div>

        <div class="form-group">
            <label>Catégorie</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
@endsection
