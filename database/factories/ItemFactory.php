<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'sku' => $this->faker->name(),
            'quantity' => rand(1,50),
            'item_categories_id' => rand(1,3),
            'user_id' => 1,
        ];
    }
}
