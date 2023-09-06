<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> User::factory()->create()->name,
            'email'=> User::factory()->create()->name,
            'phone'=> $this->faker->phoneNumber(),
            'address'=> $this->faker->address(),
        ];
    }
}
