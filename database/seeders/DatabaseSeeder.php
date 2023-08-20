<?php

namespace Database\Seeders;

use App\Models\Products\Product;
use App\Models\User;
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
        $this->call(CategoriesSeeder::class);
        // $this->call(ProductsSeeder::class);
    }
}
