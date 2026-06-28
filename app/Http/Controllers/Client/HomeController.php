<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Page d’accueil du client
    public function index()
    {
        // Produits récents
        $products = Product::latest()->take(20)->get();

        // Shops récents
        $shops = Shop::latest()->take(5)->get();

        // Promotions (exemple : produits avec discount > 0)
        $promotions = Product::where('discount', '>', 0)
                             ->latest()
                             ->take(10)
                             ->get();

        // Recommandations (exemple simple : produits aléatoires)
        $recommendations = Product::inRandomOrder()->take(5)->get();

        // Commandes du client connecté
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->take(5)
                       ->get();

        return view('client.home', compact(
            'products',
            'shops',
            'promotions',
            'recommendations',
            'orders'
        ));
    }
}
