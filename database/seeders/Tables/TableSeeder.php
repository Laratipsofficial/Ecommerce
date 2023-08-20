<?php

namespace Database\Seeders\Tables;

use App\Models\Tables\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run()
    {
        Table::create([
            'number' => 'Table 1',
        ]);

        Table::create([
            'number' => 'Table 2',
        ]);

        Table::create([
            'number' => 'Table 3',
        ]);

        Table::create([
            'number' => 'Table 4',
        ]);

        Table::create([
            'number' => 'Table 5',
        ]);
    }
}
