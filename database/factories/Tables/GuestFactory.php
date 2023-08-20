<?php

namespace Database\Factories\Tables;

use App\Models\Tables\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phonenumber' => $this->faker->word(),
            'email' => $this->faker->unique()->safeEmail(),
            'age' => $this->faker->randomNumber(),
            'reservation_id' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
