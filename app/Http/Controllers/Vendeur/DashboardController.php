<?php

namespace App\Http\Controllers\Vendeur;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $vendeurId = Auth::id();

        // Statistiques rapides
        $productsCount = Product::where('user_id', $vendeurId)->count();

        $ordersCount   = Order::whereHas('products', function ($query) use ($vendeurId) {
                                $query->where('user_id', $vendeurId);
                            })->count();

        $revenus = DB::table('order_product')
                     ->join('products', 'order_product.product_id', '=', 'products.id')
                     ->where('products.user_id', $vendeurId)
                     ->selectRaw('SUM(order_product.quantity * order_product.price) as total_revenue')
                     ->value('total_revenue');

        $clientsCount  = Order::whereHas('products', function ($query) use ($vendeurId) {
                                $query->where('user_id', $vendeurId);
                            })->distinct('user_id')->count('user_id');

        // Dernières commandes
        $latestOrders = Order::whereHas('products', function ($query) use ($vendeurId) {
                                $query->where('user_id', $vendeurId);
                            })
                            ->with('user')
                            ->latest()
                            ->take(5)
                            ->get();

        // Passer les variables à la vue
        return view('vendeur.dashboard', compact(
            'productsCount',
            'ordersCount',
            'revenus',
            'clientsCount',
            'latestOrders'
        ));
    }
}
