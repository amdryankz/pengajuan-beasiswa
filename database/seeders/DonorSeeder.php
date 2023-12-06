<?php

namespace Database\Seeders;

use App\Models\Donor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Bank Indonesia'],
            ['name' => 'BUMN'],
            ['name' => 'Osaka Gas Jepang'],
            ['name' => 'PT. Djarum'],
            ['name' => 'Yayasan Dompet Dhuafa'],
        ];

        foreach ($data as $value) {
            Donor::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
