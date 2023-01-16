<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::factory()->create([
            'order_id' => 1,
            'product_id' => 1,
            'quantity' => 1,
        ]);
        OrderDetail::factory()->create([
            'order_id' => 1,
            'product_id' => 2,
            'quantity' => 2,
        ]);
    }
}
