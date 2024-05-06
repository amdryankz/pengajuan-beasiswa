<?php

namespace Database\Factories;

use App\Models\Scholarship;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScholarshipData>
 */
class ScholarshipDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $scholarship = Scholarship::factory()->create();

        return [
            'scholarships_id' => $scholarship->id,
            'year' => $this->faker->year,
            'amount' => $this->faker->numberBetween(1000000, 10000000),
            'amount_period' => $this->faker->randomElement(['year', 'month']),
            'duration' => $this->faker->numberBetween(1, 5),
            'start_registration_at' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'end_registration_at' => $this->faker->dateTimeBetween('+7 months', '+1 year'),
            'min_ipk' => $this->faker->randomFloat(1, 2, 4),
            'quota' => json_encode([$this->faker->numberBetween(1, 10), $this->faker->numberBetween(11, 20), $this->faker->numberBetween(21, 30)]),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ScholarshipData $scholarshipData) {
            $fileRequirement = FileRequirement::factory()->create();
            $scholarshipData->requirements()->attach($fileRequirement->id);
        });
    }
}
