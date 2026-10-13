<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $roles = ['Tailor', 'Master Tailor', 'Cutter', 'Seamstress', 'Cashier', 'Manager'];

        return [
            'employee_code' => 'EMP-' . str_pad((string) fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'name' => fake()->name(),
            'role' => fake()->randomElement($roles),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'hire_date' => fake()->date(),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
