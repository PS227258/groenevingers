<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DymanticTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("dymantic_instagram_feed_tokens")->insert([
            "id" => 1,
            "profile_id" => 1,
            "access_code" =>
                'IGQWRQQ0NobU5hb1JTbEwwckxmMUNva3VNNUNjTWduczB4NUVQc20zdUNraWphXzVnRUZAPRXRzTURxMzNQY2c3V3EzQXhyVzFjOGFpNUpNLUVqX0ZATTmphOG4xNXQyQ2NDRENUSU9FXzBVUQZDZD',
            "username" => "groenevingersgv",
            "user_id" => "7315978568520886",
            "user_fullname" => "not available",
            "user_profile_picture" => "not available",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
