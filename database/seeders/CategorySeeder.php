<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    // Definition des catégories de base pour l'application
    public function run(): void
    {
        $categories = [
            'Électronique',
            'Mode',
            'Maison & Jardin',
            'Sports & Loisirs',
            'Beauté & Santé',
            'Automobile',
            'Jouets & Jeux',
            'Livres',
            'Musique',
            'Alimentation'
        ];

        // Création des catégories dans la base de données s'ils n'existent pas déjà
        foreach ($categories as $cat) {
            Category::firstOrCreate([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}
