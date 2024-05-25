<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $role = Role::factory()->create();

        return [
            'name' => Str::limit($this->faker->name, 40),
            'nip' => $this->faker->unique()->numerify('#####'),
            'password' => bcrypt('password'),
            'status' => 'Aktif',
            'role_id' => $role->id,
        ];
    }

    public function inactive(): self
    {
        return $this->state([
            'status' => 'Non-Aktif',
        ]);
    }
}
