<?php

namespace Database\Seeders\Orders;

use App\Models\Orders\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        OrderStatus::create([
            'name' => 'Pending',
            'display_name' => 'Pending',
        ]);

        OrderStatus::create([
            'name' => 'Processing',
            'display_name' => 'Processing',
        ]);

        OrderStatus::create([
            'name' => 'Completed',
            'display_name' => 'Completed',
        ]);

        OrderStatus::create([
            'name' => 'Cancelled',
            'display_name' => 'Cancelled',
        ]);
    }
}
