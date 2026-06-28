<?php

namespace App\Http\Controllers\Vendeur;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Afficher toutes les commandes liées aux produits du vendeur
    public function index()
    {
        $orders = Order::whereHas('products', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->with('user', 'products')
                    ->latest()
                    ->get();

        return view('vendeur.orders.index', compact('orders'));
    }

    // Formulaire de création d’une commande manuelle
    public function create()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('vendeur.orders.create', compact('products'));
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status'  => 'required|string',
            'total'   => 'required|numeric',
            'products'=> 'array'
        ]);

        $order = Order::create([
            'user_id' => $data['user_id'],
            'status'  => $data['status'],
            'total'   => $data['total'],
        ]);

        if (!empty($data['products'])) {
            $order->products()->attach($data['products']);
        }

        return redirect()->route('vendeur.orders.index')
                         ->with('success', 'Commande créée avec succès.');
    }

    // Afficher une commande spécifique
    public function show($id)
    {
        $order = Order::whereHas('products', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->with('user', 'products')
                    ->findOrFail($id);

        return view('vendeur.orders.show', compact('order'));
    }

    // Formulaire d’édition d’une commande
    public function edit($id)
    {
        $order = Order::whereHas('products', function ($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->with('products')
                    ->findOrFail($id);

        $products = Product::where('user_id', Auth::id())->get();

        return view('vendeur.orders.edit', compact('order', 'products'));
    }

    // Mettre à jour une commande
    public function update(Request $request, $id)
    {
        $order = Order::whereHas('products', function ($query) {
                        $query->where('user_id', Auth::id());
                    })->findOrFail($id);

        $order->update($request->only(['status', 'total']));

        if ($request->has('products')) {
            $order->products()->sync($request->products);
        }

        return redirect()->route('vendeur.orders.index')
                         ->with('success', 'Commande mise à jour.');
    }

    // Supprimer une commande
    public function destroy($id)
    {
        $order = Order::whereHas('products', function ($query) {
                        $query->where('user_id', Auth::id());
                    })->findOrFail($id);

        $order->delete();

        return redirect()->route('vendeur.orders.index')
                         ->with('success', 'Commande supprimée.');
    }
}
