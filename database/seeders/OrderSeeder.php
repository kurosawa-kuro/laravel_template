<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()->create([
            'user_id'=>1
        ]);
        Order::factory()->create([
            'user_id'=>1
        ]);
        Order::factory()->create([
            'user_id'=>2
        ]);
    }
}
