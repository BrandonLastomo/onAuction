<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(mt_rand(2,5)),
            'slug' => $this->faker->slug(),
            'category_id' => mt_rand(1, 3),
            'bid_price' => $this->faker->randomFloat(2, 2000000, 3000000),
            'desc' => $this->faker->sentence(mt_rand(5,10)),
        ];
    }
}
