<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending','paid','failed','refunded']);

        return [
            'order_id'       => Order::factory(), // commande liée
            'amount'         => $this->faker->randomFloat(2, 50, 2000), // montant payé
            'method'         => $this->faker->randomElement(['card','paypal','cash','bank_transfer']),
            'status'         => $status,
            'transaction_id' => strtoupper($this->faker->bothify('TXN-####-????')), // identifiant externe
            'paid_at'        => $status === 'paid'
                                ? $this->faker->dateTimeBetween('-6 months', 'now')
                                : null, // cohérent : date uniquement si payé
        ];
    }
}
