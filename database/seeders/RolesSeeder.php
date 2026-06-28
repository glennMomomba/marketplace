<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    // Definition des rôles de base pour l'application
    public function run(): void
    {
        $roles = [
            ['name' => 'client', 'description' => 'Client standard'],
            ['name' => 'vendor', 'description' => 'Vendeur'],
            ['name' => 'admin', 'description' => 'Administrateur'],
        ];

        // Création des rôles dans la base de données s'ils n'existent pas déjà
        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
