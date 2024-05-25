<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'image' => 'announcements/' . $this->faker->unique()->word() . '.jpg',
            'letter_number' => $this->faker->regexify('[A-Z]{3}/[0-9]{3}'),
            'content' => $this->faker->paragraph,
        ];
    }
}
