<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use App\Models\User;
use Database\Seeders\Content\CmsContentSeeder;
use Database\Seeders\Menus\MenuSectionSeeder;
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
            ->has(Product::factory()->count(7))
            ->create([
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'name' => 'Super Admin',
            ]);

        User::factory()
            ->has(Product::factory()->count(9))
            ->create([
                'email' => 'editor@editor.com',
                'password' => 'editor',
                'name' => 'Editor',
            ]);

        $this->call(RolesSeeder::class);

        // if env is not staging or production, seed the database with dummy data
        if (app()->environment(['production', 'acceptation'])) {
            $this->call(StagingSeeder::class);
            return;
        }



        $this->call(CategoriesSeeder::class);
        //$this->call(ProductsSeeder::class);
        $this->call(TableSeeder::class);

        // create menu items
        $this->call(MenuSectionSeeder::class);

        // create cms content
        $this->call(CmsContentSeeder::class);

        // create order statuses, types and order(s)


    }
}
