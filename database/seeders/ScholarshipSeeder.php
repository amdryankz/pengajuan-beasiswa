<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Bank Indonesia', 'donors_id' => '1'],
            ['name' => 'Osaka Gas', 'donors_id' => '3'],
            ['name' => 'Djarum', 'donors_id' => '4'],
            ['name' => 'BUMN', 'donors_id' => '2'],
            ['name' => 'Etos', 'donors_id' => '5'],
        ];

        foreach ($data as $value) {
            Scholarship::insert([
                'name' => $value['name'],
                'donors_id' => $value['donors_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
