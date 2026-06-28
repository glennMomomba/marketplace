<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les clients
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->get();
        
        $products = Product::all();

        if ($clients->isEmpty() || $products->isEmpty()) {
            $this->command->warn('⚠️ Aucun client ou produit trouvé. Lancez UserSeeder et ProductSeeder avant.');
            return;
        }

        // Générer des couples uniques client-produit
        $pairs = collect();

        while ($pairs->count() < 50) {
            $client  = $clients->random();
            $product = $products->random();
            $key     = $client->id . '-' . $product->id;

            if (!$pairs->contains($key)) {
                $pairs->push($key);

                Review::factory()->create([
                    'user_id'    => $client->id,
                    'product_id' => $product->id,
                ]);
            }
        }
    }
}
