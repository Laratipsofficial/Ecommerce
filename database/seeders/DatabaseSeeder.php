<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Content\CmsContentSeeder;
use Database\Seeders\Discounts\DiscountSeeder;
use Database\Seeders\Menus\MenuSectionSeeder;
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
        User::factory()
            ->create([
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'name' => 'Super Admin',
            ]);

        User::factory()
            ->create([
                'email' => 'editor@editor.com',
                'password' => 'editor',
                'name' => 'Editor',
            ]);

        $this->call(RolesSeeder::class);

        $shouldStage = app()->environment(['production', 'acceptation']);

        if (true) {
            $this->call(StagingSeeder::class);
          //  return;
        }

        $this->call(TableSeeder::class);

        // create menu items
       // $this->call(MenuSectionSeeder::class);

        // create cms content
        $this->call(CmsContentSeeder::class);

        // create order statuses, types and order(s)
        $this->call(OrderStatusSeeder::class);
        $this->call(OrderTypeSeeder::class);

        // seed discounts
        $this->call(DiscountSeeder::class);


    }
}
