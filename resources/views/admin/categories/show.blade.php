@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Détails de la catégorie</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>{{ $category->name }}</h4>
            <p>{{ $category->description }}</p>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">⬅️ Retour</a>
        </div>
    </div>
</div>
@endsection
