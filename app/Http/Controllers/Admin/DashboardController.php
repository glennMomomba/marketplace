<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord Admin
     */
    public function index()
    {
        // Statistiques globales
        $productsCount   = Product::count();
        $categoriesCount = Category::count();
        $ordersCount     = Order::count();
        $reviewsCount    = Review::count();
        $usersCount      = User::count();

        // Dernières commandes avec utilisateur
        $latestOrders = Order::with('user')
                             ->latest()
                             ->take(5)
                             ->get();

        // Revenus globaux (si champ total existe dans orders)
        $revenus = Order::sum('total');

        // Passer les variables à la vue
        return view('admin.dashboard', compact(
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'usersCount',
            'latestOrders',
            'revenus'
        ));
    }
}
