<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // Les seeders pour remplir la base de données avec des données initiales
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UserSeeder::class,
            ShopsSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrdersSeeder::class,
            PaymentsSeeder::class,
            ReviewsSeeder::class,
            CartsSeeder::class,
        ]);
    }
}
