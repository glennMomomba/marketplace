<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relation avec l'utilisateur (acheteur / client)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Infos principales
            $table->decimal('total_price', 10, 2)->default(0);

            // Statut de la commande
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])->default('pending');

            // Champs supplémentaires utiles
            $table->string('shipping_address')->nullable(); // adresse de livraison
            $table->string('billing_address')->nullable();  // adresse de facturation
            $table->timestamp('ordered_at')->useCurrent();  // date de la commande

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
