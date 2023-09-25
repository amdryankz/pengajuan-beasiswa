<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Admin'],
            ['name' => 'Operator Fakultas Ekonomi dan Bisnis'],
            ['name' => 'Operator Fakultas Kedokteran Hewan'],
            ['name' => 'Operator Fakultas Hukum'],
            ['name' => 'Operator Fakultas Teknik'],
            ['name' => 'Operator Fakultas Pertanian'],
            ['name' => 'Operator Fakultas KIP'],
            ['name' => 'Operator Fakultas Kedokteran'],
            ['name' => 'Operator Fakultas MIPA'],
            ['name' => 'Operator Fakultas Pasca Sarjana'],
            ['name' => 'Operator Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['name' => 'Operator Fakultas Kelautan dan Perikanan'],
            ['name' => 'Operator Fakultas Keperawatan'],
            ['name' => 'Operator Fakultas Kedokteran Gigi'],
        ];

        foreach ($data as $value) {
            Role::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}