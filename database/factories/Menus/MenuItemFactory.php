<?php

namespace Database\Factories\Menus;

use App\Models\Menu\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'number' => $this->faker->randomNumber(),
            'number_addition' => $this->faker->word(),
            'price' => $this->faker->word(),
            'menu_section_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
