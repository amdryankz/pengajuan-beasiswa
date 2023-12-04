<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    private $scholarshipId;

    public function __construct($scholarshipId)
    {
        $this->scholarshipId = $scholarshipId;
    }

    public function model(array $row)
    {
        $user = User::where('nim', $row[0])->first();

        return new UserScholarship([
            'scholarship_data_id' => $this->scholarshipId,
            'user_id' => $user->id,
            'status_file' => true,
            'status_scholar' => true,
        ]);
    }
}
