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
            'password' => '$2y$10$M2gyFI6FxpfenuRpgv5GKeL5Xhxw15t2t8l7KDxTEfLdkFzCXfdqG',
            'name' => 'M Suhail Haritsah',
            'prodi' => 'Informatika',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
