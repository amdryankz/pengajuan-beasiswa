<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\FileRequirement;
use App\Models\ScholarshipData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserScholarship>
 */
class UserScholarshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'scholarship_data_id' => ScholarshipData::factory()->create()->id,
            'file_requirement_id' => FileRequirement::factory()->create()->id,
            'file_path' => $user->npm . '.pdf',
            'file_status' => null,
            'scholarship_status' => null,
            'supervisor_approval_file' => $user->npm . '_Izin Dosen Wali.pdf',
        ];
    }
}
