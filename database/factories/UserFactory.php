<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'npm' => $this->faker->unique()->numerify('#############'),
            'password' => bcrypt('password'),
            'name' => $this->faker->name,
            'major' => $this->faker->word,
            'faculty' => $this->faker->word,
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'ipk' => $this->faker->randomFloat(2, 3.00, 4.00),
            'total_sks' => $this->faker->numberBetween(1, 150),
            'active_status' => 'Aktif',
            'graduate_status' => 'Belum Lulus',
            'birthdate' => $this->faker->date,
            'birthplace' => $this->faker->city,
            'address' => $this->faker->address,
            'email' => 'kassumanette@gmail.com',
            'parent_name' => $this->faker->name,
            'parent_job' => 'PNS',
            'parent_income' => $this->faker->randomElement(['< 1 Juta', '1-3 Juta', '3-5 Juta', '> 5 Juta']),
            'phone_number' => $this->faker->unique()->randomNumber(8),
            'bank_account_number' => $this->faker->unique()->randomNumber(8),
            'account_holder_name' => $this->faker->name,
            'bank_name' => 'BSI',
        ];
    }
}
