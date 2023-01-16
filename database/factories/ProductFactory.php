<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => rand(1,3),
            'name' =>  $this->faker->name(),
            'image' => 'https://i.pravatar.cc/300',
            'description' => 'dummy description', // password
            'price' => 100,
            'quantity' => 10,
        ];
    }
}
