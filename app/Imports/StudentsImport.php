<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    private $scholarshipId;

    public $unlinkedNPMCount = 0;

    public function __construct($scholarshipId)
    {
        $this->scholarshipId = $scholarshipId;
    }

    public function hasUnlinkedNPM()
    {
        return $this->unlinkedNPMCount > 0;
    }

    public function model(array $row)
    {
        $user = User::where('npm', $row[0])->first();

        if (!$user) {
            $this->unlinkedNPMCount++;

            return null;
        }

        return new UserScholarship([
            'scholarship_data_id' => $this->scholarshipId,
            'user_id' => $user->id,
            'file_status' => true,
            'scholarship_status' => true,
        ]);
    }
}
