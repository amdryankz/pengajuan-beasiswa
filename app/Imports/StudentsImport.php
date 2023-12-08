<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\UserScholarship;
use App\Models\User;

class StudentsImport implements ToModel
{
    private $scholarshipId;
    public $unlinkedNIMCount = 0;

    public function __construct($scholarshipId)
    {
        $this->scholarshipId = $scholarshipId;
    }

    public function hasUnlinkedNIM()
    {
        return $this->unlinkedNIMCount > 0;
    }

    public function model(array $row)
    {
        $user = User::where('nim', $row[0])->first();

        if (!$user) {
            $this->unlinkedNIMCount++;
            return null;
        }

        return new UserScholarship([
            'scholarship_data_id' => $this->scholarshipId,
            'user_id' => $user->id,
            'status_file' => true,
            'status_scholar' => true,
        ]);
    }
}
