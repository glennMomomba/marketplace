@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Détails de l’utilisateur</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            <p><strong>Rôles :</strong>
                @foreach($user->roles as $role)
                    <span class="badge bg-success">{{ $role->name }}</span>
                @endforeach
            </p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">⬅️ Retour</a>
        </div>
    </div>
</div>
@endsection
