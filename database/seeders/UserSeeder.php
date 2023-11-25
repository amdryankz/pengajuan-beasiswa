<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::insert([
            'nim' => '2008107010040',
            'password' => '$2y$10$M2gyFI6FxpfenuRpgv5GKeL5Xhxw15t2t8l7KDxTEfLdkFzCXfdqG',
            'name' => 'M Suhail Haritsah',
            'prodi' => 'Informatika',
            'fakultas' => 'MIPA',
            'ipk' => '4.00',
            'jk' => 'Laki-Laki',
            'birthplace' => 'Sigli',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $nim = '200810701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Informatika';
            $fakultas = 'MIPA';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'nim' => $nim,
                'password' => $password,
                'name' => $name,
                'prodi' => $prodi,
                'fakultas' => $fakultas,
                'ipk' => $ipk,
                'jk' => $jk,
                'birthplace' => $birthplace,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]);
        }
    }
}
