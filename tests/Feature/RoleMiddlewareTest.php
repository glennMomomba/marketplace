<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_user_can_access_admin_route()
    {
        // Crée un rôle admin
        $role = Role::firstOrCreate(['name' => config('roles.admin')]);

        // Crée un utilisateur avec ce rôle
        $user = User::factory()->create();
        $user->roles()->attach($role);

        // Simule une requête sur une route protégée
        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(200); // ✅ accès autorisé
    }

    #[Test]
    public function non_admin_user_cannot_access_admin_route()
    {
        // Crée un rôle client
        $role = Role::firstOrCreate(['name' => config('roles.client')]);

        // Crée un utilisateur avec ce rôle
        $user = User::factory()->create();
        $user->roles()->attach($role);

        // Simule une requête sur une route protégée
        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertStatus(403); // ❌ accès interdit
    }
}
