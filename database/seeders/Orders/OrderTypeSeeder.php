<?php

namespace Database\Seeders\Orders;

use App\Models\Orders\OrderType;
use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    public function run()
    {
        OrderType::create([
            'name' => 'Dine In',
            'display_name' => 'Dine In',
        ]);

        OrderType::create([
            'name' => 'Take Away',
            'display_name' => 'Take Away',
        ]);
    }
}
