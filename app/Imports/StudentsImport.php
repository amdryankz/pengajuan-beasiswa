<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserScholarship;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    private $scholarshipId;

    public $unlinkedNPMs = [];

    public function __construct($scholarshipId)
    {
        $this->scholarshipId = $scholarshipId;
    }

    public function hasUnlinkedNPM()
    {
        return count($this->unlinkedNPMs) > 0;
    }

    public function model(array $row)
    {
        $user = User::where('npm', $row[0])->first();

        if (!$user) {
            $this->unlinkedNPMs[] = $row[0];

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
