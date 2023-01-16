<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // use RefreshDatabase;

    private function testSeeder()
    {
        User::truncate();

        $this->seed(UserSeeder::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_create()
    {
        $this->testSeeder();
        dd(User::get()->toArray());

        $this->assertTrue(true);
    }
}
