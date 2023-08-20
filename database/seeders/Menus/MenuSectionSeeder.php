<?php

namespace Database\Seeders\Menus;

use App\Models\Menu\MenuSection;
use Illuminate\Database\Seeder;

class MenuSectionSeeder extends Seeder
{
    public function run()
    {
        MenuSection::create([
            'name' => 'Appetizers',
        ]);

        MenuSection::create([
            'name' => 'Main Course',
        ]);

        MenuSection::create([
            'name' => 'Desserts',
        ]);

        MenuSection::create([
            'name' => 'Beverages',
        ]);

        // create menu items for each menu section
        $menuSections = MenuSection::all();

        foreach ($menuSections as $menuSection) {
            $menuSection->menuItems()->createMany(
                [
                    [
                        'name' => 'Chicken Wings',
                        'description' => 'Crispy fried chicken wings',
                        'price' => 10.00,
                    ],
                    [
                        'name' => 'Chicken Satay',
                        'description' => 'Grilled chicken skewers with peanut sauce',
                        'price' => 12.00,
                    ],
                    [
                        'name' => 'Spring Rolls',
                        'description' => 'Deep fried spring rolls with sweet chilli sauce',
                        'price' => 8.00,
                    ],
                    [
                        'name' => 'Pad Thai',
                        'description' => 'Stir fried rice noodles with prawns, tofu, peanuts, bean sprouts, and egg',
                        'price' => 15.00,
                    ],
                    [
                        'name' => 'Green Curry',
                        'description' => 'Green curry with chicken, bamboo shoots, and basil',
                        'price' => 15.00,
                    ],
                    [
                        'name' => 'Massaman Curry',
                        'description' => 'Massaman curry with beef, potatoes, and peanuts',
                        'price' => 15.00,
                    ],
                    [
                        'name' => 'Mango Sticky Rice',
                        'description' => 'Mango sticky rice with coconut milk',
                        'price' => 8.00,
                    ],
                    [
                        'name' => 'Thai Iced Tea',
                        'description' => 'Thai iced tea with milk',
                        'price' => 5.00,
                    ],
                    [
                        'name' => 'Thai Iced Coffee',
                        'description' => 'Thai iced coffee with milk',
                        'price' => 5.00,
                    ],
                ]
            );
        }
    }
}
