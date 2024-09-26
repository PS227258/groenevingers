<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_statuses')->insert([
            "name" => "Ontvangen"
        ]);

        DB::table('order_statuses')->insert([
            "name" => "Betaald"
        ]);

        DB::table('order_statuses')->insert([
            "name" => "Verwerkt"
        ]);

        DB::table('order_statuses')->insert([
            "name" => "Verzonden"
        ]);

        DB::table('order_statuses')->insert([
            "name" => "Afgeleverd"
        ]);

        DB::table('order_statuses')->insert([
            "name" => "Geannuleerd"
        ]);
    }
}
