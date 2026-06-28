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
        // Création de la table "shops" pour les boutiques
        Schema::create('shops', function (Blueprint $table) {
            $table->id();

            // Relation avec l'utilisateur (vendeur propriétaire)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Infos principales
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Champs supplémentaires utiles
            $table->string('logo')->nullable();     // logo de la boutique
            $table->string('address')->nullable();  // adresse physique ou virtuelle
            $table->string('phone')->nullable();    // contact de la boutique
            $table->enum('status', ['active', 'inactive'])->default('active'); // état de la boutique

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
