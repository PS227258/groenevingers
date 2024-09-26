<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("user_statuses")->insert([
            "name" => "Actief",
        ]);

        DB::table("user_statuses")->insert([
            "name" => "Ziek",
        ]);

        DB::table("user_statuses")->insert([
            "name" => "Vakantie",
        ]);
    }
}
