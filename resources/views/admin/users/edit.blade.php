@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Modifier l’utilisateur</h2>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe (laisser vide si inchangé)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="roles" class="form-label">Rôles</label>
            <select name="roles[]" id="roles" class="form-control" multiple required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" 
                        @if($user->roles->contains($role->id)) selected @endif>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Maintenez CTRL (ou CMD sur Mac) pour sélectionner plusieurs rôles.</small>
        </div>
        <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
    </form>
</div>
@endsection
