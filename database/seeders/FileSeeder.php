<?php

namespace Database\Seeders;

use App\Models\FileRequirement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'CV'],
            ['name' => 'Fotokopi Kartu Keluarga'],
            ['name' => 'Fotokopi KTP'],
            ['name' => 'Surat Tanah'],
            ['name' => 'Fotokopi keadaan rumah orang tua tinggal'],
        ];

        foreach ($data as $value) {
            FileRequirement::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
