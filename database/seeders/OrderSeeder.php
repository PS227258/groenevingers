<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Orderrow;
use Illuminate\Database\Seeder;

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
