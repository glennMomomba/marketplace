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
        // Création de la table 'products' avec les champs nécessaires
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Informations principales
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);

            // Stock et statut
            $table->integer('stock')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Relations
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // vendeur
            $table->foreignId('shop_id')->nullable()->constrained('shops')->onDelete('cascade'); // boutique

            // Champs supplémentaires utiles
            $table->string('slug')->nullable()->unique(); // URL friendly
            $table->string('sku')->nullable()->unique(); // référence produit
            $table->string('image')->nullable(); // image principale

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
