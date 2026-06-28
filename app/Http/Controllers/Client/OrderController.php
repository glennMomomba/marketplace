<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Afficher toutes les commandes du client
    public function index()
    {
        $orders = Order::with('products')
                       ->where('user_id', Auth::id())
                       ->latest()
                       ->get();

        return view('client.orders.index', compact('orders'));
    }

    // Créer une commande à partir du panier
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartProducts()->withPivot('quantity')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Votre panier est vide.');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'status'  => 'en cours',
            'total'   => $cartItems->sum(fn($item) => $item->price * $item->pivot->quantity),
        ]);

        foreach ($cartItems as $item) {
            if ($item->stock >= $item->pivot->quantity) {
                $order->products()->attach($item->id, [
                    'quantity' => $item->pivot->quantity,
                    'price'    => $item->price,
                ]);

                $item->decrement('stock', $item->pivot->quantity);
            } else {
                return back()->with('error', "Le produit {$item->name} n'a pas assez de stock.");
            }
        }

        // Vider le panier
        $user->cartProducts()->detach();

        return redirect()->route('client.orders.index')
                         ->with('success', 'Commande créée avec succès.');
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $order = Order::with('products')
                      ->where('user_id', Auth::id())
                      ->findOrFail($id);

        return view('client.orders.show', compact('order'));
    }

    // Annuler une commande
    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status === 'en cours') {
            $order->update(['status' => 'annulée']);
        }

        return redirect()->route('client.orders.index')
                         ->with('success', 'Commande annulée.');
    }
}
