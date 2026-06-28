<?php

namespace Database\Factories;

use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    protected $model = OrderProduct::class;

    public function definition(): array
    {
        return [
            'order_id'   => Order::factory(),   // commande liée
            'product_id' => Product::factory(), // produit lié
            'quantity'   => $this->faker->numberBetween(1, 3), // plus réaliste
            'price'      => $this->faker->randomFloat(2, 20, 1500), // prix unitaire réaliste
        ];
    }
}
