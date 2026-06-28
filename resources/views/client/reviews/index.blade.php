@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-primary">📝 Mes avis</h2>
    <ul class="list-group mt-3">
        @foreach($reviews as $review)
            <li class="list-group-item">
                <strong>Produit :</strong> {{ $review->product->name }} <br>
                <strong>Note :</strong> {{ $review->rating }}/5 <br>
                <strong>Commentaire :</strong> {{ $review->comment }}
            </li>
        @endforeach
    </ul>
    {{ $reviews->links() }}
</div>
@endsection
