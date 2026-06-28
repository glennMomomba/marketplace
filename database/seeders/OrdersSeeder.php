<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les clients
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->get();

        if ($clients->isEmpty()) {
            $this->command->warn('⚠️ Aucun client trouvé. Lancez UserSeeder avant.');
            return;
        }

        // Générer 20 commandes
        foreach ($clients->random(10) as $client) {
            $order = Order::factory()->create([
                'user_id' => $client->id,
            ]);

            // Attacher entre 1 et 5 produits par commande
            $products = Product::all();

            foreach ($products as $product) {
                $quantity = rand(1, 3);
                $order->products()->attach($product->id, [
                    'quantity' => $quantity,
                    'price'    => $product->price,
                ]);
            }

            // Recalculer le total de la commande
            $total = $order->products->sum(function ($p) {
                return $p->pivot->quantity * $p->pivot->price;
            });

            $order->update(['total_price' => $total]);
        }
    }
}
