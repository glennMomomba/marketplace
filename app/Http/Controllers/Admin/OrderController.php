<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Afficher toutes les commandes
     */
    public function index()
    {
        $orders = Order::with('user', 'products')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.orders.create', compact('products'));
    }

    /**
     * Enregistrer une nouvelle commande
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'status'  => 'required|string|max:50',
            'total'   => 'required|numeric|min:0',
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

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Commande créée avec succès.');
    }

    /**
     * Afficher une commande spécifique
     */
    public function show($id)
    {
        $order = Order::with('user', 'products')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Formulaire d’édition
     */
    public function edit($id)
    {
        $order = Order::with('products')->findOrFail($id);
        $products = Product::all();
        return view('admin.orders.edit', compact('order', 'products'));
    }

    /**
     * Mettre à jour une commande
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'status'  => 'required|string|max:50',
            'total'   => 'required|numeric|min:0',
            'products'=> 'array'
        ]);

        $order->update([
            'status' => $data['status'],
            'total'  => $data['total'],
        ]);

        if (!empty($data['products'])) {
            $order->products()->sync($data['products']);
        }

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Commande mise à jour.');
    }

    /**
     * Supprimer une commande
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Commande supprimée.');
    }
}
