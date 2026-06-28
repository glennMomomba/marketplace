@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Modifier le rôle</h2>
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom du rôle</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $role->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">💾 Mettre à jour</button>
    </form>
</div>
@endsection
