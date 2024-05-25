<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::limit($this->faker->unique()->jobTitle, 40),
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'id' => 1,
                'name' => 'Admin',
            ];
        });
    }

    public function operator()
    {
        return $this->state(function (array $attributes) {
            return [
                'id' => 2,
                'name' => 'Operator',
            ];
        });
    }

    public function viewer()
    {
        return $this->state(function (array $attributes) {
            return [
                'id' => 3,
                'name' => 'Viewer',
            ];
        });
    }
}
