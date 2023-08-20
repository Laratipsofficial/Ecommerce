<?php

namespace Database\Factories\Orders;

use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'status_id' => $this->faker->word(),
            'type_id' => $this->faker->word(),
            'price' => $this->faker->word(),
            'discount' => $this->faker->word(),
            'comment' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
