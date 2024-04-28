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
            'npm' => '2008107010040',
            'password' => '$2y$10$M2gyFI6FxpfenuRpgv5GKeL5Xhxw15t2t8l7KDxTEfLdkFzCXfdqG',
            'name' => 'M Suhail Haritsah',
            'major' => 'Informatika',
            'faculty' => 'MIPA',
            'ipk' => '4.00',
            'gender' => 'Laki-Laki',
            'birthplace' => 'Sigli',
            'total_sks' => 120,
            'birthdate' => Carbon::createFromDate(2000, 1, 1),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $npm = '200810701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Informatika';
            $faculty = 'MIPA';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200110701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Teknik Komputer';
            $faculty = 'Teknik';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200210701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Akuntansi';
            $faculty = 'Ekonomi dan Bisnis';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200310701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Manajemen Agribisnis';
            $faculty = 'Pertanian';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200410701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Ilmu Hukum';
            $faculty = 'Hukum';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200510701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'PPKN';
            $faculty = 'KIP';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200610701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Sosiologi';
            $faculty = 'Ilmu Sosial dan Ilmu Politik';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200710701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Pendidikan Dokter';
            $faculty = 'Kedokteran';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '200910701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Pendidikan Dokter Gigi';
            $faculty = 'Kedokteran Gigi';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '201010701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Kesehatan Hewan';
            $faculty = 'Kedokteran Hewan';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '201110701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Ilmu Kelautan';
            $faculty = 'Kelautan dan Perikanan';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            $npm = '201210701000' . $i;
            $name = $faker->name;
            $password = Hash::make('testing');
            $major = 'Ilmu Keperawatan';
            $faculty = 'Keperawatan';
            $ipk = number_format($faker->randomFloat(2, 2, 4), 2);
            $gender = $faker->randomElement(['Laki-Laki', 'Perempuan']);
            $birthplace = $faker->city;
            $total_sks = $faker->numberBetween(40, 130); // Adjust the range based on your requirements
            $birthdate = $faker->dateTimeBetween('-20 years', '-18 years')->format('Y-m-d');
            $created_at = Carbon::now();
            $updated_at = Carbon::now();

            User::insert([
                'npm' => $npm,
                'password' => $password,
                'name' => $name,
                'major' => $major,
                'faculty' => $faculty,
                'ipk' => $ipk,
                'gender' => $gender,
                'birthplace' => $birthplace,
                'total_sks' => $total_sks,
                'birthdate' => $birthdate,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
    }
}
