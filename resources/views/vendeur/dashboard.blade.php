@extends('layouts.vendeur')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold text-success">📊 Tableau de bord Vendeur</h2>

    <!-- Statistiques -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <div class="col">
            <div class="card text-center shadow-lg border-0 rounded">
                <div class="card-body">
                    <i class="fas fa-box-open text-primary fs-2 mb-2"></i>
                    <h5 class="card-title">Produits</h5>
                    <p class="card-text fs-4 fw-bold">{{ $productsCount }}</p>
                    <a href="{{ route('vendeur.products.index') }}" class="btn btn-outline-primary btn-sm">Voir</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center shadow-lg border-0 rounded">
                <div class="card-body">
                    <i class="fas fa-shopping-cart text-warning fs-2 mb-2"></i>
                    <h5 class="card-title">Commandes</h5>
                    <p class="card-text fs-4 fw-bold">{{ $ordersCount }}</p>
                    <a href="{{ route('vendeur.orders.index') }}" class="btn btn-outline-warning btn-sm">Voir</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center shadow-lg border-0 rounded">
                <div class="card-body">
                    <i class="fas fa-coins text-success fs-2 mb-2"></i>
                    <h5 class="card-title">Revenus</h5>
                    <p class="card-text fs-4 fw-bold">{{ $revenus }} MAD</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-center shadow-lg border-0 rounded">
                <div class="card-body">
                    <i class="fas fa-users text-danger fs-2 mb-2"></i>
                    <h5 class="card-title">Clients</h5>
                    <p class="card-text fs-4 fw-bold">{{ $clientsCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dernières commandes -->
    <div class="mt-5">
        <h4 class="fw-bold text-success">🆕 Dernières commandes</h4>
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestOrders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>{{ $order->total }} MAD</td>
                            <td>
                                @if($order->status === 'en cours')
                                    <span class="badge bg-warning text-dark">🟠 En cours</span>
                                @elseif($order->status === 'livrée')
                                    <span class="badge bg-success">✅ Livrée</span>
                                @elseif($order->status === 'annulée')
                                    <span class="badge bg-danger">❌ Annulée</span>
                                @else
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune commande récente.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
