<?php

namespace App\Http\Controllers\Vendeur;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Afficher la liste des produits du vendeur connecté
    public function index()
    {
        $products = Product::with('category')
                           ->where('user_id', Auth::id())
                           ->get();

        return view('vendeur.products.index', compact('products'));
    }

    // Formulaire de création d’un produit
    public function create()
    {
        $categories = Category::all();
        return view('vendeur.products.create', compact('categories'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['user_id'] = Auth::id(); // ✅ rattacher le produit au vendeur connecté

        Product::create($data);

        return redirect()->route('vendeur.products.index')
                         ->with('success', 'Produit ajouté avec succès.');
    }

    // Afficher un produit spécifique
    public function show($id)
    {
        $product = Product::with('category')
                          ->where('user_id', Auth::id())
                          ->findOrFail($id);

        return view('vendeur.products.show', compact('product'));
    }

    // Formulaire d’édition d’un produit
    public function edit($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::all();

        return view('vendeur.products.edit', compact('product', 'categories'));
    }

    // Mettre à jour un produit
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('vendeur.products.index')
                         ->with('success', 'Produit mis à jour.');
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $product = Product::where('user_id', Auth::id())->findOrFail($id);
        $product->delete();

        return redirect()->route('vendeur.products.index')
                         ->with('success', 'Produit supprimé.');
    }
}
