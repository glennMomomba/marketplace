<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifier qu'il existe des shops et des catégories
        $shops = Shop::all();
        $categories = Category::all();

        if ($shops->isEmpty() || $categories->isEmpty()) {
            $this->command->warn('⚠️ Aucun shop ou catégorie trouvé. Lancez ShopsSeeder et CategorySeeder avant.');
            return;
        }

        // Générer 50 produits réalistes
        Product::factory()
            ->count(50)
            ->make()
            ->each(function ($product) use ($shops, $categories) {
                $shop = $shops->random();
                $category = $categories->random();

                $product->shop_id = $shop->id;
                $product->category_id = $category->id;
                $product->user_id = $shop->user_id; // propriétaire du shop
                $product->stock = rand(5, 50); // stock aléatoire
                $product->slug = Str::slug($product->name . '-' . $shop->id.'-'.uniqid()); //  slug unique
                $product->save();
            });
    }
}
