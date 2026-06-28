<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id'          => User::factory(), // acheteur
            'total_price'      => $this->faker->randomFloat(2, 100, 5000), 
            'status'           => $this->faker->randomElement([
                'pending', 'paid', 'shipped', 'completed', 'cancelled'
            ]),
            'shipping_address' => $this->faker->streetAddress() . ', ' . $this->faker->city(),
            'billing_address'  => $this->faker->streetAddress() . ', ' . $this->faker->city(),
            'ordered_at'       => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
