<?php

namespace Database\Factories\Orders;

use App\Models\Orders\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'table_round' => $this->faker->randomNumber(),
            'order_id' => $this->faker->randomNumber(),
            'menu_item_id' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),
            'quantity' => $this->faker->randomNumber(),
            'menu_side_item_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
