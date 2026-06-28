<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


// ==========================
// IMPORTS ADMIN
// ==========================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

// ==========================
// IMPORTS VENDEUR
// ==========================
use App\Http\Controllers\Vendeur\DashboardController as VendeurDashboardController;
use App\Http\Controllers\Vendeur\ShopController as VendeurShopController;
use App\Http\Controllers\Vendeur\ProductController as VendeurProductController;
use App\Http\Controllers\Vendeur\OrderController as VendeurOrderController;

// ==========================
// IMPORTS CLIENT
// ==========================
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ShopController as ClientShopController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\ReviewController;

// ==========================
// PROFIL GLOBAL
// ==========================
use App\Http\Controllers\ProfileController;

// ==========================
// PAGE D’ACCUEIL PUBLIQUE
// ==========================
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;

Route::get('/', function () {
    $categories   = Category::all();
    $products     = Product::with('category')->latest()->take(20)->get();
    $shops        = Shop::all();
    $cartCount    = DB::table('cart_product')->count();
    $ordersCount  = Order::count();

    return view('welcome', compact('categories', 'products', 'shops', 'ordersCount', 'cartCount'));
})->name('welcome');

// ==========================
// CLIENT
// ==========================
Route::prefix('client')->middleware(['auth', 'role:'.Config::get('roles.client')])->name('client.')->group(function () {
    Route::get('/home', [ClientHomeController::class, 'index'])->name('home');
    Route::resource('products', ClientProductController::class);
    Route::resource('cart', CartController::class);
    Route::resource('orders', ClientOrderController::class);
    Route::resource('shops', ClientShopController::class);
    Route::resource('profile', ClientProfileController::class);
    Route::resource('reviews', ReviewController::class);

});

// ==========================
// ADMIN
// ==========================
Route::prefix('admin')->middleware(['auth', 'role:'.Config::get('roles.admin')])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', AdminOrderController::class);
});

// ==========================
// VENDEUR
// ==========================
Route::prefix('vendeur')->name('vendeur.')->group(function () {
    Route::get('/dashboard', [VendeurDashboardController::class, 'index'])->name('vendeur.dashboard');
    Route::resource('shops', VendeurShopController::class);
    Route::resource('products', VendeurProductController::class);
    Route::resource('orders', VendeurOrderController::class);
});

// ==========================
// PROFIL UTILISATEUR GLOBAL
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
