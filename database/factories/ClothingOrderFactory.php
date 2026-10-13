<?php

namespace Database\Factories;

use App\Models\ClothingOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClothingOrder>
 */
class ClothingOrderFactory extends Factory
{
    public function definition(): array
    {
        $garments = ['Barong', 'Barong Tagalog', 'School Uniform', 'Pants', 'Skirt', 'Blouse', 'Dress', 'Suit', 'Coat', 'Alteration', 'Other'];
        $statuses = ['Pending', 'In Progress', 'Ready', 'Completed', 'Cancelled'];

        return [
            'order_code' => 'ORD-' . str_pad((string) fake()->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'customer_id' => \App\Models\Customer::factory(),
            'employee_id' => fake()->boolean(80) ? \App\Models\Employee::factory() : null,
            'garment_type' => fake()->randomElement($garments),
            'fabric' => fake()->randomElement(['Linen', 'Cotton', 'Piqué', 'Rayon', 'Polyester', 'Silk Blend']),
            'color' => fake()->randomElement(['Cream', 'Navy', 'Black', 'White', 'Beige', 'Maroon']),
            'size' => fake()->randomElement(['Custom', 'S', 'M', 'L', 'XL']),
            'order_date' => fake()->date(),
            'due_date' => fake()->dateTimeBetween('now', '+14 days')->format('Y-m-d'),
            'total_amount' => fake()->randomFloat(2, 200, 5000),
            'status' => fake()->randomElement($statuses),
            'special_instructions' => fake()->boolean(30) ? fake()->sentence() : null,
        ];
    }
}
