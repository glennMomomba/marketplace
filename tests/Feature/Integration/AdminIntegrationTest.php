<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_admin_journey()
    {
        // 1. Connexion admin
        $admin = User::factory()->create();
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $admin->roles()->attach($roleAdmin);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);

        // 2. Dashboard global
        $this->actingAs($admin)->get('/admin/dashboard')->assertSee('Utilisateurs');

        // 3. Gestion catégories
        $this->actingAs($admin)->post('/admin/categories', ['name' => 'Électronique']);
        $this->assertDatabaseHas('categories', ['name' => 'Électronique']);

        // 4. Gestion commandes
        $this->actingAs($admin)->get('/admin/orders')->assertStatus(200);

        // 5. Gestion utilisateurs
        $user = User::factory()->create();
        $roleUser = Role::firstOrCreate(['name' => 'client']);
        $user->roles()->attach($roleUser);

        // Update utilisateur avec rôles
        $this->actingAs($admin)->put("/admin/users/{$user->id}", [
            'name'  => 'Modifié',
            'email' => $user->email,
            'roles' => [$roleUser->id], // ✅ ajout des rôles
        ]);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Modifié']);

        // Delete utilisateur (on peut aussi envoyer roles pour cohérence)
        $this->actingAs($admin)->delete("/admin/users/{$user->id}", [
            'roles' => [$roleUser->id]
        ]);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);

        // 6. Logout admin
        $this->actingAs($admin)->post('/logout');
        $this->assertGuest();
    }
}
