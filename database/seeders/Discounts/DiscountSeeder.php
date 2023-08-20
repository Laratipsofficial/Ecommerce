<?php

namespace Database\Seeders\Discounts;

use App\Models\Discount\Discount;
use App\Models\Menu\MenuItem;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        Discount::create([
            'name' => 'Discount 1',
            'description' => 'Discount 1',
            'starts_at' => now(),
            'ends_at' => now()->addDays(7),
        ]);

        Discount::create([
            'name' => 'Discount 2',
            'description' => 'Discount 2',
            'starts_at' => now()->addDays(7),
            'ends_at' => now()->addDays(14),
        ]);

        // create discount items per discount
        // retrieve all menu items and attach them to the discount and decrease the price by 40%

        // retrieve all menu items
        $menuItems = MenuItem::all();

        // retrieve all discounts
        $discounts = Discount::all();

        // loop through each discount
        foreach ($discounts as $discount) {
            // loop through each menu item
            foreach ($menuItems as $menuItem) {
                // calculate the discounted price
                $discountedPrice = $menuItem->price - ($menuItem->price * 0.4);

                // create the discount item
                $discount->discountItems()->create([
                    'menu_item_id' => $menuItem->id,
                    'discount' => $discountedPrice,
                ]);
            }
        }
    }
}
