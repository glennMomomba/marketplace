<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $productName = $this->faker->randomElement([
            'Chaussures de sport Nike Air Zoom',
            'Ordinateur portable Dell Inspiron 15',
            'Smartphone Samsung Galaxy S26',
            'Montre connectée Apple Watch Series 9',
            'Casque audio Bose QuietComfort',
            'Sac à dos Eastpak Padded',
            'Tablette iPad Air 2026',
            'Caméra Canon EOS R10',
            'Vélo de route Trek Domane',
            'Parfum Dior Sauvage Eau de Parfum'
        ]);

        return [
            'name'        => $productName,
            'slug'        => Str::slug($productName . '-' . uniqid()), // slug unique
            'description' => $this->faker->realTextBetween(100, 180), // description plus naturelle
            'price'       => $this->faker->randomFloat(2, 50, 2000),
            'category_id' => Category::inrandomOrder()->value('id') , // associé à une catégorie existante
            'user_id'     => User::factory(),     // vendeur fictif
        ];
    }
}
