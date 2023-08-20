<?php

namespace Database\Factories\Discounts;

use App\Models\Discount\DiscountItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DiscountItemFactory extends Factory
{
    protected $model = DiscountItem::class;

    public function definition()
    {
        return [
            'discount' => $this->faker->word(),
            'discount_id' => $this->faker->word(),
            'menu_item_id' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
