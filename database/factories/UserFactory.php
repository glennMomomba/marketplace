<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'name'              => $name, // ex: "Jean Dupont"
            'email'             => $this->faker->unique()->safeEmail(), // ex: "jean.dupont@example.com"
            'email_verified_at' => null, // nulle par défaut
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(10), // cohérent avec Laravel
        ];
    }

    /**
     * État pour un utilisateur vérifié
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => now()
        ]);
    }


    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
