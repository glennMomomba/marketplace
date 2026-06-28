@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Détails du rôle</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $role->name }}</p>
            <p><strong>Description :</strong> {{ $role->description }}</p>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">⬅️ Retour</a>
        </div>
    </div>
</div>
@endsection
