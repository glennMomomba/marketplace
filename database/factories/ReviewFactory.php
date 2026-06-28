<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        $rating = $this->faker->numberBetween(1, 5);

        // Générer un commentaire cohérent avec la note
        $comments = [
            1 => [
                "Très déçu, le produit ne correspond pas à la description.",
                "Qualité médiocre, je ne recommande pas."
            ],
            2 => [
                "Pas terrible, quelques défauts visibles.",
                "Produit correct mais ne vaut pas le prix."
            ],
            3 => [
                "Produit moyen, conforme mais sans plus.",
                "Ça fait le job mais rien d’exceptionnel."
            ],
            4 => [
                "Bon produit, satisfait de mon achat.",
                "Bonne qualité, livraison rapide."
            ],
            5 => [
                "Excellent produit, je recommande vivement !",
                "Parfait, exactement ce que je cherchais."
            ],
        ];

        return [
            'user_id'     => User::factory(),    // auteur de l'avis
            'product_id'  => Product::factory(), // produit concerné
            'rating'      => $rating,
            'comment'     => $this->faker->randomElement($comments[$rating]),
            'approved'    => $this->faker->boolean(90), // 90% des avis sont approuvés
            'reviewed_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
