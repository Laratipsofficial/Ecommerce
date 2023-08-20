<?php

namespace Database\Factories\Content;

use App\Models\Content\CmsContent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CmsContentFactory extends Factory
{
    protected $model = CmsContent::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'seoTitle' => $this->faker->word(),
            'seoDescription' => $this->faker->text(),
            'displayName' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
