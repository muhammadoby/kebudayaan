<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Culture>
 */
class CultureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $names = ['Tarian', 'Karya sastra', 'Lukisan', 'Tradisi',];
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'name' => $names[rand(0, count($names) - 1)],
            'description' => $this->faker->paragraphs(3, true),
        ];
    }
}
