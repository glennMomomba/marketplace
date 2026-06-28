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
        // Création de la table 'categories' avec les champs nécessaires
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // Nom unique de la catégorie
            $table->string('name')->unique();

            // Champs supplémentaires utiles
            $table->string('slug')->unique(); // pour les URLs SEO-friendly
            $table->text('description')->nullable(); // description de la catégorie
            $table->string('image')->nullable(); // image illustrant la catégorie

            // Relations éventuelles (catégories parent/enfant)
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
