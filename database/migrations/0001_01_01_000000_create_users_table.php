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
        // Table users, avec des champs de base et quelques champs supplémentaires pour plus de flexibilité 
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Infos de base
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // Champs supplémentaires utiles
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('avatar')->nullable(); // photo de profil

            // Champs Laravel par défaut
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        
        // Table password_reset_tokens pour gérer les tokens de réinitialisation de mot de passe, avec un champ email pour identifier l'utilisateur et un champ token pour stocker le token de réinitialisation
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Table sessions pour gérer les sessions des utilisateurs, avec un champ id pour identifier la session, un champ user_id pour lier la session à un utilisateur, un champ ip_address pour stocker l'adresse IP de l'utilisateur, un champ user_agent pour stocker les informations sur le navigateur de l'utilisateur, un champ payload pour stocker les données de la session et un champ last_activity pour stocker le timestamp de la dernière activité de la session
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void // Lors de la suppression de la table users, on supprime également les tables liées (sessions, password_reset_tokens, role_user, roles) pour éviter les données orphelines et maintenir l'intégrité de la base de données
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
