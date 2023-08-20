<?php

namespace Database\Factories\Menus;

use App\Models\Menu\MenuSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class MenuSectionFactory extends Factory
{
    protected $model = MenuSection::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
