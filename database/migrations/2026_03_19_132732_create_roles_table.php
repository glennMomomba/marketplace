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
        // Création de la table "roles" avec les colonnes "id", "name", "description" et les timestamps
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();// ajouté la contrainte d'unicité pour le nom du rôle
            $table->string('description')->nullable(); // ajouté une colonne description pour le rôle
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
