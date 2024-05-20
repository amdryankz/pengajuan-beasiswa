<?php

namespace App\Observers;

use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Support\Facades\Storage;

class ScholarshipDataObserver
{
    /**
     * Handle the ScholarshipData "updated" event.
     */
    public function updated(ScholarshipData $scholarshipData): void
    {
        if ($scholarshipData->isDirty('end_scholarship') && $scholarshipData->end_scholarship < now()) {
            $userScholarships = UserScholarship::where('scholarship_data_id', $scholarshipData->id)->get();

            foreach ($userScholarships as $userScholarship) {
                if ($userScholarship->file_path && Storage::disk('public')->exists('file_requirements/' . $userScholarship->file_path)) {
                    Storage::disk('public')->delete('file_requirements/' . $userScholarship->file_path);
                    $userScholarship->file_path = null;
                }

                if ($userScholarship->supervisor_approval_file && Storage::disk('public')->exists('file_requirements/' . $userScholarship->supervisor_approval_file)) {
                    Storage::disk('public')->delete('file_requirements/' . $userScholarship->supervisor_approval_file);
                    $userScholarship->supervisor_approval_file = null;
                }

                $userScholarship->save();
            }
        }
    }
}
