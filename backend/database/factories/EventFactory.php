<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(), 
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->country(). ', ' .$this->faker->city(),
            'ticket' => mt_rand(10000, 1000000),
        ];
    }
}
