@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-primary">📦 Mes commandes</h2>

    @if($orders->isEmpty())
        <p class="text-muted">Vous n'avez pas encore passé de commande.</p>
    @else
        <div class="accordion mt-3" id="ordersAccordion">
            @foreach($orders as $order)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}">
                            Commande #{{ $order->id }} — {{ ucfirst($order->status) }} — Total : {{ $order->total }} €
                        </button>
                    </h2>
                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                        <div class="accordion-body">
                            <ul class="list-group">
                                @foreach($order->products as $product)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $product->name }}</strong><br>
                                            Prix : {{ $product->price }} €<br>
                                            Quantité : {{ $product->pivot->quantity }}
                                        </div>
                                        <span class="badge bg-secondary">Sous-total : {{ $product->price * $product->pivot->quantity }} €</span>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="mt-3">
                                <form action="{{ route('client.orders.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" 
                                            @if($order->status !== 'en cours') disabled @endif>
                                        Annuler la commande
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
