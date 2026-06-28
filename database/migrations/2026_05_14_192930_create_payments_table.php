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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Relation avec la commande
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');

            // Infos principales
            $table->decimal('amount', 10, 2); // montant payé
            $table->enum('method', ['card', 'paypal', 'cash', 'bank_transfer'])->default('card'); // méthode de paiement
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending'); // état du paiement

            // Champs supplémentaires utiles
            $table->string('transaction_id')->nullable(); // identifiant externe (PayPal, Stripe…)
            $table->timestamp('paid_at')->nullable(); // date effective du paiement

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
