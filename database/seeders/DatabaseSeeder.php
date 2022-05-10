<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com'),
            'name' => 'Super Admin',
        ]);

        User::factory()->create([
            'email' => 'editor@editor.com',
            'password' => bcrypt('editor@editor.com'),
            'name' => 'Editor',
        ]);

        $this->call(RolesSeeder::class);
    }
}
