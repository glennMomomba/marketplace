<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Afficher le contenu du panier
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartProducts()->withPivot('quantity')->get();

        return view('client.cart.index', compact('cartItems'));
    }

    // Ajouter un produit au panier
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // Attacher le produit au panier via la table pivot cart_product
        $user->cartProducts()->syncWithoutDetaching([
            $request->product_id => ['quantity' => $request->quantity],
        ]);

        return back()->with('success', 'Produit ajouté au panier.');
    }

    // Mettre à jour la quantité d’un produit
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $user->cartProducts()->updateExistingPivot($id, [
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Quantité mise à jour.');
    }

    // Retirer un produit du panier
    public function destroy($id)
    {
        $user = Auth::user();
        $user->cartProducts()->detach($id);

        return redirect()->route('client.cart.index')
                         ->with('success', 'Produit retiré du panier.');
    }

    // Transformer le panier en commande
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = $user->cartProducts()->withPivot('quantity')->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Votre panier est vide.');
        }

        // Créer la commande
        $order = Order::create([
            'user_id' => $user->id,
            'status'  => 'pending',
            'total'   => $cartItems->sum(fn($item) => $item->price * $item->pivot->quantity),
        ]);

        // Créer les items de commande
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->id,
                'quantity'   => $item->pivot->quantity,
                'price'      => $item->price,
            ]);

            // Décrémenter le stock
            $item->decrement('stock', $item->pivot->quantity);
        }

        // Vider le panier
        $user->cartProducts()->detach();

        return redirect()->route('client.orders.show', $order->id)
                         ->with('success', 'Commande créée avec succès.');
    }
}
