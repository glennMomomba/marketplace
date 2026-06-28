<?php

namespace App\Http\Controllers\Vendeur;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Afficher la liste des shops du vendeur connecté
     */
    public function index()
    {
        $shops = Shop::where('user_id', Auth::id())->get();
        return view('vendor.shop.index', compact('shops'));
    }

    /**
     * Formulaire de création d’un shop
     */
    public function create()
    {
        return view('vendor.shop.create');
    }

    /**
     * Enregistrer un nouveau shop
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Shop::create([
            'user_id'     => Auth::id(),
            'name'        => $request->name,
            'slug'        => \Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('vendor.shop.index')
                         ->with('success', 'Boutique créée avec succès.');
    }

    /**
     * Afficher une boutique spécifique
     */
    public function show($id)
    {
        $shop = Shop::where('user_id', Auth::id())->findOrFail($id);
        return view('vendor.shop.show', compact('shop'));
    }

    /**
     * Formulaire d’édition d’une boutique
     */
    public function edit($id)
    {
        $shop = Shop::where('user_id', Auth::id())->findOrFail($id);
        return view('vendor.shop.edit', compact('shop'));
    }

    /**
     * Mettre à jour une boutique
     */
    public function update(Request $request, $id)
    {
        $shop = Shop::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $shop->update([
            'name'        => $request->name,
            'slug'        => \Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('vendor.shop.index')
                         ->with('success', 'Boutique mise à jour avec succès.');
    }

    /**
     * Supprimer une boutique
     */
    public function destroy($id)
    {
        $shop = Shop::where('user_id', Auth::id())->findOrFail($id);
        $shop->delete();

        return redirect()->route('vendor.shop.index')
                         ->with('success', 'Boutique supprimée.');
    }
}
