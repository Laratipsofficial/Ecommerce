<?php

namespace Database\Factories\Tables;

use App\Models\Tables\Attention;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AttentionFactory extends Factory
{
    protected $model = Attention::class;

    public function definition()
    {
        return [
            'table_id' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
