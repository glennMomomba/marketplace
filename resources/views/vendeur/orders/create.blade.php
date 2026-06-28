@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Nouvelle commande</h2>
    <form action="{{ route('vendeur.orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Client</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" name="total" id="total" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">✅ Enregistrer</button>
    </form>
</div>
@endsection
