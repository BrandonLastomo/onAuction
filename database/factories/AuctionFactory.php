<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction>
 */
class AuctionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_id' => mt_rand(1, 11),
            'user_id' => mt_rand(2, 5),
            'ends_in' => mt_rand(1, 5),
            'sold_price' => $this->faker->randomFloat(2, 500000, 3000000)
        ];
    }
}
