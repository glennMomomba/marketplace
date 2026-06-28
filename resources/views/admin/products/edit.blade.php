@extends('layouts.admin')

@section('content')
    <h1>Modifier le Produit</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label>Prix</label>
            <input type="number" name="price" class="form-control" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label>Catégorie</label>
            <select name="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
