<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@marketplace.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        // Vendeurs
        $vendors = [
            ['name' => 'Vendor 1', 'email' => 'vendor1@marketplace.com'],
            ['name' => 'Vendor 2', 'email' => 'vendor2@marketplace.com'],
            ['name' => 'Vendor 3', 'email' => 'vendor3@marketplace.com'],
        ];

        $vendorRole = Role::where('name', 'vendor')->first();
        foreach ($vendors as $vendorData) {
            $vendor = User::firstOrCreate(
                ['email' => $vendorData['email']],
                [
                    'name' => $vendorData['name'],
                    'password' => bcrypt('password'),
                ]
            );
            if ($vendorRole) {
                $vendor->roles()->syncWithoutDetaching([$vendorRole->id]);
            }
        }

        // Clients
        $clientRole = Role::where('name', 'client')->first();
        $clients = User::factory()->count(10)->create();
        foreach ($clients as $client) {
            if ($clientRole) {
                $client->roles()->syncWithoutDetaching([$clientRole->id]);
            }
        }
    }
}
