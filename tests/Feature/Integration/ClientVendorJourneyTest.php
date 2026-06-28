<?php

namespace Tests\Feature\Integration;

use App\Models\User;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Order;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientVendorJourneyTest extends TestCase
{
    use RefreshDatabase;

    public function test_full_client_vendor_journey()
    {
        // 1. Inscription client
        $response = $this->post('/register', [
            'name' => 'Client Test',
            'email' => 'client@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '037474948844',
            'address' => 'rue Alain Blezerd'        
        ]);
        $this->assertAuthenticated();
        $response->assertRedirect('/client/home');
        $user = User::where('email', 'client@example.com')->first();

        $roleClient = Role::firstOrCreate(['name' => 'client']);
        $user->roles()->attach($roleClient->id);

        $roleVendor = Role::firstOrCreate(['name' => 'vendor']);
        $user->roles()->attach($roleVendor->id);

        // 2. Espace client : navigation
        $this->actingAs($user)->get('/client/home')->assertStatus(200);
        $this->actingAs($user)->get('/client/products')->assertStatus(200);
        $this->actingAs($user)->get('/client/shops')->assertStatus(200);
        $this->actingAs($user)->get('/client/orders')->assertStatus(200);

        // 2bis. Actions client : review + panier
        $product = Product::factory()->create();
        $this->actingAs($user)->post('/client/reviews', [
            'product_id' => $product->id,
            'rating' => 5,
            'comment' => 'Excellent produit !',
        ]);
        $this->assertDatabaseHas('reviews', ['product_id' => $product->id]);

        $this->actingAs($user)->post('/client/cart', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $this->assertDatabaseHas('cart_product', [
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);


        $this->actingAs($user)->get('/vendeur/dashboard')->assertStatus(200);

        // 3. Ouverture boutique
        $shopResponse = $this->actingAs($user)->post('/client/shops', [
            'name' => 'Ma Boutique',
            'description' => 'Boutique test',
        ]);
        $this->assertDatabaseHas('shops', [
            'name' => 'Ma Boutique',
            'user_id' => $user->id,
        ]);

        $shopResponse->assertRedirect('/client/shops');

        // 4. Espace vendeur : gestion produits
        $this->actingAs($user)->get('/vendeur/dashboard')->assertStatus(200);
        $this->actingAs($user)->post('/vendeur/products', [
            'name' => 'Produit Vendeur',
            'price' => 100,
            'stock' => 10,
        ]);
        $this->assertDatabaseHas('products', ['name' => 'Produit Vendeur']);

        $this->actingAs($user)->get('/vendeur/orders')->assertStatus(200);

        // 5. Retour espace client
        $this->actingAs($user)->get('/client/home')->assertStatus(200);

        // 6. Logout vendeur
        $this->actingAs($user)->post('/logout');
        $this->assertGuest();

        // 7. Logout client (même logique)
        $this->post('/logout');
        $this->assertGuest();
    }
}
