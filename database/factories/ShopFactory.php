<?php

namespace Database\Factories;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    protected $model = Shop::class;

    public function definition(): array
    {
        $shopName = $this->faker->company(); // ex: "Boutique Dupont SARL"

        return [
            'user_id'     => User::factory(), // propriétaire
            'name'        => $shopName,
            'slug'        => Str::slug($shopName . '-' . uniqid()), // slug unique
            'description' => $this->faker->realTextBetween(80, 150), // description plus naturelle
            'address'     => $this->faker->streetAddress() . ', ' . $this->faker->city(), // localisation réaliste
            'phone'       => $this->faker->phoneNumber(), // contact fictif
        ];
    }
}
