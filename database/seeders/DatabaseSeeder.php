<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            BranchesSeeder::class,
            UserStatusesSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            OrderStatusesSeeder::class,
            OrderrowStatusesSeeder::class,
            DymanticProfileSeeder::class,
            DymanticTokenSeeder::class,
        ]);
    }
}
