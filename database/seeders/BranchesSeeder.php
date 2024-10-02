<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            'name' => 'Veldhoven',
        ]);

        DB::table('branches')->insert([
            'name' => 'Nuenen',
        ]);

        DB::table('branches')->insert([
            'name' => 'Best',
        ]);
    }
}
