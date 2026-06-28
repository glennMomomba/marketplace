<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Liste des produits
    public function index()
    {
        $products    = Product::with('category')->latest()->paginate(20);
        $categories  = Category::all();

        $user = Auth::user();
        $cartItems = $user
            ? $user->cartProducts()->withPivot('quantity')->get()
            : collect(); // si pas connecté, panier vide

        return view('client.products.index', compact('products', 'categories', 'cartItems'));
    }

    // Détails d’un produit
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $user = Auth::user();
        $cartItems = $user
            ? $user->cartProducts()->withPivot('quantity')->get()
            : collect();

        return view('client.products.show', compact('product', 'cartItems'));
    }
}
