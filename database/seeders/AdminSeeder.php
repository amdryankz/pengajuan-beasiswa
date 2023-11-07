<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::insert([
            'nip' => '2008107010041',
            'password' => '$2y$10$M2gyFI6FxpfenuRpgv5GKeL5Xhxw15t2t8l7KDxTEfLdkFzCXfdqG',
            'status' => 'Active',
            'role_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}