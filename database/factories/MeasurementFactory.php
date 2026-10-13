<?php

namespace Database\Factories;

use App\Models\Measurement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Measurement>
 */
class MeasurementFactory extends Factory
{
    public function definition(): array
    {
        $unit = fake()->randomElement(['in', 'cm']);
        $base = $unit === 'in' ? 30 : 76;

        return [
            'customer_id' => \App\Models\Customer::factory(),
            'clothing_order_id' => fake()->boolean(40) ? \App\Models\ClothingOrder::factory() : null,
            'chest' => fake()->randomFloat(2, $base + 2, $base + 12),
            'waist' => fake()->randomFloat(2, $base - 10, $base + 2),
            'hip' => fake()->randomFloat(2, $base, $base + 10),
            'shoulder' => fake()->randomFloat(2, 14, 22),
            'sleeve' => fake()->randomFloat(2, 22, 32),
            'neck' => fake()->randomFloat(2, 14, 19),
            'length' => fake()->randomFloat(2, 24, 34),
            'unit' => $unit,
            'notes' => fake()->boolean(25) ? fake()->sentence() : null,
        ];
    }
}
