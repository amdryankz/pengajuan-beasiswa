<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'nim' => '2008107010040',
            'password' => 'testing',
            'name' => 'M Suhail Haritsah',
            'prodi' => 'Informatika',
            'fakultas' => 'Matematika dan Ilmu Pengetahuan Alam',
            'ipk' => '4.00',
            'jk' => 'Laki-Laki',
            'birthplace' => 'Sigli',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
