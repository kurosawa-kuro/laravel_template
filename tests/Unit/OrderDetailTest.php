<?php

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Database\Seeders\OrderDetailSeeder;
use Database\Seeders\OrderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderDetailTest extends TestCase
{
    // use RefreshDatabase;

    private function testSeeder()
    {
        User::truncate();
        $this->seed(UserSeeder::class);

        Order::truncate();
        $this->seed(OrderSeeder::class);

        OrderDetail::truncate();
        $this->seed(OrderDetailSeeder::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_create()
    {
        $this->testSeeder();
//        dd(User::get()->toArray());

        dd(OrderDetail::get()->toArray());

        $this->assertTrue(true);
    }
}
