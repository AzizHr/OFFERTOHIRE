<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OfferLike>
 */
class OfferLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'offer_id' => Offer::factory(),
            'user_id' => User::factory()
        ];
    }
}
