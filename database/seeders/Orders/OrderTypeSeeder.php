<?php

namespace Database\Seeders\Orders;

use App\Models\Orders\OrderType;
use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    public function run()
    {
        OrderType::create([
            'name' => 'dine-in',
            'display_name' => 'Dine In',
        ]);

        OrderType::create([
            'name' => 'take-away',
            'display_name' => 'Take Away',
        ]);
    }
}
