<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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
            'total_sks' => 120,
            'birthdate' => Carbon::createFromDate(2000, 1, 1),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $nim = '200810701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Informatika';
            $fakultas = 'MIPA';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200110701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Teknik Komputer';
            $fakultas = 'Teknik';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200210701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Akuntansi';
            $fakultas = 'Ekonomi dan Bisnis';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200310701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Manajemen Agribisnis';
            $fakultas = 'Pertanian';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200410701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Ilmu Hukum';
            $fakultas = 'Hukum';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200510701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'PPKN';
            $fakultas = 'KIP';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200610701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Sosiologi';
            $fakultas = 'Ilmu Sosial dan Ilmu Politik';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200710701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Pendidikan Dokter';
            $fakultas = 'Kedokteran';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '200910701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Pendidikan Dokter Gigi';
            $fakultas = 'Kedokteran Gigi';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '201010701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Kesehatan Hewan';
            $fakultas = 'Kedokteran Hewan';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '201110701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Ilmu Kelautan';
            $fakultas = 'Kelautan dan Perikanan';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $nim = '201210701000'.$i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $prodi = 'Ilmu Keperawatan';
            $fakultas = 'Keperawatan';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $jk = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
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
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}
