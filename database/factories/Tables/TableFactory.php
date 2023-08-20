<?php

namespace Database\Factories\Tables;

use App\Models\Tables\Table;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TableFactory extends Factory
{
    protected $model = Table::class;

    public function definition()
    {
        return [
            'number' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
