<?php

namespace Database\Factories\Menus;

use App\Models\Menu\MenuSideItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MenuSideItemFactory extends Factory
{
    protected $model = MenuSideItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
