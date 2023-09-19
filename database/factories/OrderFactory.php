<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // $table->id();
            // $table->string('order_number')->unique();
            // $table->unsignedBigInteger('customer_id');
            // $table->dateTime('order_date');
            // $table->string('order_status');
            // $table->timestamps();
            // $table->string('customer_name');
            // $table->integer('customer_phone');
            // $table->string('customer_email')->unique();
            // $table->string('customer_address');
            // $table->integer('total');
            // $table->json('order_items');

            'order_number' => $this->faker->unique()->numberBetween(10000, 99999),
            // 'customer_id' => Customer::factory()->create()->id,
            'order_date' => $this->faker->dateTime(),
            'order_status' => $this->faker->randomElement(['pending', 'processing', 'completed']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' =>$this->faker->dateTime(),
            'customer_name' =>Customer::factory()->create()->name,
            'customer_phone' => Customer::factory()->create()->phone,
            'customer_email' =>Customer::factory()->create()->email,
            'customer_address' => Customer::factory()->create()->address,
            'total' => $this->faker->randomNumber(5),
            'order_items' => json_encode(
                [
                    'product_name' => Product::factory()->create()->name,
                    'quantity' => $this->faker->numberBetween(1, 10),
                    'price' => Product::factory()->create()->price,
                    'discount' => $this->faker->randomFloat(2, 0, 20),
                ]),
        ];
    }
}
