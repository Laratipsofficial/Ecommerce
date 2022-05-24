<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'parent_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'active' => $this->faker->boolean(70),
        ];
    }

    public function root()
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => null,
            ];
        });
    }
}
