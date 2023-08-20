<?php

namespace Database\Factories\Orders;

use App\Models\Orders\OrderType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderTypeFactory extends Factory
{
    protected $model = OrderType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'display_name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
