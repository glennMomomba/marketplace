@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2>Mes Commandes</h2>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->total }} MAD</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('vendeur.orders.show', $order->id) }}" class="btn btn-info btn-sm">👁️ Voir</a>
                        <a href="{{ route('vendeur.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">✏️ Modifier</a>
                        <form action="{{ route('vendeur.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }} <!-- pagination -->
</div>
@endsection
