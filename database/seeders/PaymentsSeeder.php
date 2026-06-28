<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Payment;

class PaymentsSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer toutes les commandes
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->warn('⚠️ Aucune commande trouvée. Lancez OrdersSeeder avant.');
            return;
        }

        foreach ($orders as $order) {
            // Générer un paiement pour chaque commande
            Payment::factory()->create([
                'order_id' => $order->id,
                'amount'   => $order->total_price, // montant = total de la commande
                'status'   => fake()->randomElement(['pending','paid','failed','refunded']),
                'method'   => fake()->randomElement(['card','paypal','cash','bank_transfer']),
                'paid_at'  => fake()->optional()->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
