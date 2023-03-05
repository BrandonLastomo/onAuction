<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Auction_history>
 */
class AuctionHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'auction_id' => mt_rand(1, 3),
            'user_id' => mt_rand(3, 5),
            'bid_amount' => $this->faker->randomFloat(2, 400000, 2000000)
        ];
    }
}
