<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DymanticProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("dymantic_instagram_basic_profiles")->insert([
            "id" => 1,
            "username" => "groenevingersgv",
            "identity_token" =>
                'aSOa8s2lENceeaOY',
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
