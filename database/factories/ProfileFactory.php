<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_rank' =>$this->faker->text($maxNbChars = 5),
            'dive_count' =>$this->faker->numberBetween($min = 20, $max = 500),
            'profile_image' => 'uploads/null.png',
            'cover_image' => 'uploads/cover.jpg',
            'user_id' => \App\Models\User::factory()->create()->id
        ];
    }
}
