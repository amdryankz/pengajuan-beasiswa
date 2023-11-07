<?php

namespace App\Imports;

use App\Models\SpecScholarship;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{

    protected $scholarship_data_id;

    public function __construct($scholarship_data_id)
    {
        $this->scholarship_data_id = $scholarship_data_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new SpecScholarship([
            'scholarship_data_id' => $this->scholarship_data_id,
            'list_students' => $row[0],
        ]);
    }
}
