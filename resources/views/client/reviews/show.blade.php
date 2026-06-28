@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-primary">Avis sur {{ $review->product->name }}</h2>
    <p><strong>Note :</strong> {{ $review->rating }}/5</p>
    <p><strong>Commentaire :</strong> {{ $review->comment }}</p>
    <p><strong>Auteur :</strong> {{ $review->user->name }}</p>
</div>
@endsection
