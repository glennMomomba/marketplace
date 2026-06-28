<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class CartsSeeder extends Seeder
{
    public function run()
    {
        $clients = User::whereHas('roles', fn($q) => $q->where('name', 'client'))->get();
        $products = Product::all();

        foreach ($clients as $client) {
            // Sélectionner entre 1 et 3 produits aléatoires
            $selectedProducts = $products->random(rand(1, 3));

            foreach ($selectedProducts as $product) {
                $client->cartProducts()->syncWithoutDetaching([
                    $product->id => ['quantity' => rand(1, 3)],
                ]);
            }
        }
    }
}
