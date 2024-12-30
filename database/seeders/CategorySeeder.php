<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Programmation', 'description' => 'Cours de programmation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Design', 'description' => 'Cours de design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Marketing', 'description' => 'Cours de marketing', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
