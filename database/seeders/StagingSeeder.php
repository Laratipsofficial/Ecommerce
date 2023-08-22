<?php

namespace Database\Seeders;

use App\Models\Menu\MenuItem;
use App\Models\Menu\MenuSection;
use App\Models\Menu\MenuSideItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StagingSeeder extends Seeder
{
    public function run()
    {
        $database = DB::connection('mysql');

        // get staging sql script and execute it
        $sql = file_get_contents(base_path('staging.sql'));

        $database->getPdo()->exec($sql);

        $items = $database->table('menu')->get();


       // witte rijst, nasi/bami goreng, mihoen goreng of chinese bami wil.

    // add menu side items
        MenuSideItem::create([
            'name' => 'Witte rijst',
            'price' => 2.00,
        ]);

        MenuSideItem::create([
            'name' => 'Nasi Goreng',
            'price' => 2.00,
        ]);

        MenuSideItem::create([
            'name' => 'Bami Goreng',
            'price' => 2.00,
        ]);

        MenuSideItem::create([
            'name' => 'Mihoen Goreng',
            'price' => 2.00,
        ]);

        foreach ($items as $item) {
            $section = MenuSection::query()->where('name', $item->soortgerecht)->first();

            if ($section == null) {
                $section = MenuSection::create([
                    'name' => $item->soortgerecht
                ]);
            }
            MenuItem::create([
                'number' => $item->menunummer,
                'number_addition' => $item->menu_toevoeging,
                'name' => $item->naam,
                'price' => $item->price,
                'menu_section_id' => $section->id,
                'description' => $item->beschrijving,
            ]);
        }

        // drop table menu, specialiteiten, gebruikers, menu_pdf, rijs_enzo
        $database->getPdo()->exec('DROP TABLE menu');
        $database->getPdo()->exec('DROP TABLE specialiteiten');
        $database->getPdo()->exec('DROP TABLE gebruiker');
        $database->getPdo()->exec('DROP TABLE menu_pdf');
        $database->getPdo()->exec('DROP TABLE rijst_enzo');

    }
}
