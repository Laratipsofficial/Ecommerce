<?php

namespace Database\Seeders\Orders;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSideItem;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use App\Models\Tables\Table;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $orderStatuses = [1, 2, 3, 4]; // Assuming you have status IDs
        $orderTypes = [1, 2, 3, 4]; // Assuming you have type IDs

        $totalOrders = 100;

        for ($i = 1; $i <= $totalOrders; $i++) {
            $statusId = $faker->randomElement($orderStatuses);
            $typeId = $faker->randomElement($orderTypes);

            $order = Order::create([
                'status_id' => $statusId,
                'type_id' => $typeId,
                'price' => $faker->randomFloat(2, 10, 100),
                'discount' => $faker->randomFloat(2, 0, 20),
                'comment' => $faker->sentence(),
                'table_id' => $typeId === 1 ? Table::inRandomOrder()->first()->id : null,
                'created_at' => $this->getRandomCreatedAt($statusId),
            ]);

            $totalItems = rand(5, 40);
            for ($j = 1; $j <= $totalItems; $j++) {
                $menuItem = MenuItem::inRandomOrder()->first();
                $sideItem = MenuSideItem::inRandomOrder()->first();

                OrderItem::create([
                    'table_round' => $typeId === 1 ? $faker->numberBetween(1, 10) : null,
                    'order_id' => $order->id,
                    'menu_item_id' => $menuItem->id,
                    'price' => $menuItem->price,
                    'quantity' => $faker->numberBetween(1, 5),
                    'menu_side_item_id' => $sideItem ? $sideItem->id : null,
                    'comment' => $faker->sentence(),
                    'discount' => $faker->randomFloat(2, 0, 10),
                ]);
            }
        }
    }

    private function getRandomCreatedAt($statusId)
    {
        $now = Carbon::now();

        if ($statusId === 1 || $statusId === 2) {
            return $now->subMinutes(rand(30, 120));
        } else {
            return $now->subHours(rand(6, 72));
        }
    }
}
