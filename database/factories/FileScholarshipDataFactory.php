<?php

namespace Database\Factories;

use App\Models\FileRequirement;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ScholarshipData;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FileScholarshipData>
 */
class FileScholarshipDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'scholarship_data_id' => ScholarshipData::factory()->create()->id,
            'file_requirement_id' => FileRequirement::factory()->create()->id,
        ];
    }
}
