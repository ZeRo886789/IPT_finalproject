<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'clothing_order_id' => \App\Models\ClothingOrder::factory(),
            'payment_date' => fake()->date(),
            'amount' => fake()->randomFloat(2, 50, 1000),
            'payment_method' => fake()->randomElement(['Cash', 'GCash', 'Bank Transfer', 'Card']),
            'reference_no' => fake()->boolean(40) ? fake()->bothify('REF-####') : null,
            'status' => fake()->randomElement(['Paid', 'Pending', 'Refunded']),
            'notes' => fake()->boolean(20) ? fake()->sentence() : null,
        ];
    }
}
