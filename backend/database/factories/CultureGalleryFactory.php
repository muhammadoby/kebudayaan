<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Culture;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CultureGallery>
 */
class CultureGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            '/culture-gallery/culture-0.jpg',
            '/culture-gallery/culture-1.jpg',
            '/culture-gallery/culture-2.jpg',
            '/culture-gallery/culture-3.jpg',
            '/culture-gallery/culture-4.jpg',
        ];

        return [
            'culture_id' => Culture::inRandomOrder()->first()->id ?? Culture::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(3, true),
            'image' => $images[mt_rand(0, 4)]
        ];
    }
}
