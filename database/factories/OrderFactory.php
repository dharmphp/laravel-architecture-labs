<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_number' => 'ORD-' . $this->faker->unique()->numberBetween(100000, 999999),
            'amount' => $this->faker->randomFloat(2, 50, 5000),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'created_at' => now(),
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'completed_at' => now(),
            ];
        });
    }
}
