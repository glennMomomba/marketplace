@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-primary">{{ $shop->name }}</h2>
    <p>{{ $shop->description }}</p>
</div>
@endsection
