@extends('layouts.admin')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Prix : {{ $product->price }} €</p>
    <p>Catégorie : {{ $product->category->name }}</p>
@endsection
