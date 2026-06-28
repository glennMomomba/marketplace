@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Mes Boutiques</h2>

    {{-- Message flash --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulaire de création --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('client.shops.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la boutique</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Créer ma boutique</button>
            </form>
        </div>
    </div>

    {{-- Liste des boutiques --}}
    <div class="row">
        @forelse($shops as $shop)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>{{ $shop->name }}</h5>
                        <p>{{ $shop->description }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucune boutique pour le moment.</p>
        @endforelse
    </div>
</div>
@endsection
