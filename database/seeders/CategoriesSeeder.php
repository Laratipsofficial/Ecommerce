<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->root()->hasChildren(1)->create();
        Category::factory(1)->root()->create();
        Category::factory()->root()->hasChildren(3)->create();
        Category::factory()->root()->hasChildren(2)->create();
        Category::factory(1)->root()->create();
    }
}
