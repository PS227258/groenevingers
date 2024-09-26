<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderrowStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orderrow_statuses')->insert([
            'name' => 'Verpakken'
        ]);

        DB::table('orderrow_statuses')->insert([
            'name' => 'Gereed'
        ]);

        DB::table('orderrow_statuses')->insert([
            'name' => 'Retour'
        ]);
    }
}
