<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = Category::inrandomOrder()->first(10); // Récupère 10 noms de catégories existantes
        $name = $categories ? $categories->name : ucfirst($this->faker->word()); // Utilise un nom existant ou génère un nouveau nom unique
        return [
            'name'        => $name, // nom réaliste et unique
            'slug'        => Str::slug($name), // slug basé sur le nom → cohérent
            'description' => $this->faker->sentence(12), // description plus longue et naturelle
        ];
    }
}
