<?php

namespace Database\Seeders;

use Database\Seeders\Content\CmsContentSeeder;
use Database\Seeders\Discounts\DiscountSeeder;
use Database\Seeders\Orders\OrdersSeeder;
use Database\Seeders\Orders\OrderStatusSeeder;
use Database\Seeders\Orders\OrderTypeSeeder;
use Database\Seeders\Tables\TableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(OrderTypeSeeder::class);


        $shouldStage = app()->environment(['production', 'acceptation']);

        if (true) {
            $this->call(StagingSeeder::class);
          //  return;
        }

        $isProduction = app()->environment('production');

        if ($isProduction) {
            return;
        }

        $this->call(TableSeeder::class);

        // create cms content
        $this->call(CmsContentSeeder::class);

        // create order statuses, types and order(s)
        $this->call(DiscountSeeder::class);

        $this->call(OrdersSeeder::class);
    }
}
