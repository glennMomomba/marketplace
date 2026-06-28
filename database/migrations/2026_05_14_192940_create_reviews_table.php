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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');   // auteur de l'avis
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // produit concerné

            // Contenu de l'avis
            $table->tinyInteger('rating')->unsigned(); // 1 à 5
            $table->text('comment')->nullable();

            // Champs supplémentaires utiles
            $table->boolean('approved')->default(true); // modération éventuelle
            $table->timestamp('reviewed_at')->useCurrent(); // date de l'avis

            $table->timestamps();

            // Empêcher les doublons (un utilisateur ne peut pas laisser deux avis sur le même produit)
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
