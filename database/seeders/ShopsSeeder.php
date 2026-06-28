<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use app\Models\Role;
use App\Models\Shop;
use Illuminate\Support\Str;

class ShopsSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer tous les vendeurs
        $vendorRole = Role::where('name', 'vendor')->first();
        $vendors = $vendorRole ? $vendorRole->users : collect();

        foreach ($vendors as $vendor) {
            // Créer une boutique pour chaque vendeur
            $vendor->shops()->create([
                'user_id' => $vendor->id,
                'name' => $vendor->name . "'s Shop",
                'description' => 'This is the shop of ' . $vendor->name,
                'address' => '123 Main St, City, Country',
                'phone' => '123-456-7890',
                'slug' => Str::slug($vendor->name . "-shop"),
            ]);
        }
    }
}
