<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->create([
            'name' => 'dummy product1',
            'price' => 100,
            'quantity' => 10,
        ]);
        Product::factory()->create([
            'name' => 'dummy product2',
            'price' => 200,
            'quantity' => 20,
        ]);
        Product::factory()->create([
            'name' => 'dummy product3',
            'price' => 50,
            'quantity' => 5,
        ]);
        Product::factory()->create([
            'name' => 'dummy product4',
            'price' => 400,
            'quantity' => 30,
        ]);
    }
}
