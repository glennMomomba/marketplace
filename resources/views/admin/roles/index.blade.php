@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Gestion des Rôles</h2>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">➕ Ajouter un rôle</a>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>
                                <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info btn-sm">👁️ Voir</a>
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $roles->links() }} <!-- pagination -->
        </div>
    </div>
</div>
@endsection
