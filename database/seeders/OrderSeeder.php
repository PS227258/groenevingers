<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Orderrow;
use Database\Factories\OrderrowFactory;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Orderrow::factory()->recycle(Order::factory()->count(40)->create())->count(100)->create();
    }
}
