<?php

namespace App\Console\Commands;

use App\Models\ScholarshipData;
use App\Models\UserScholarship;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DeleteExpiredFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete files associated with expired scholarships';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredScholarships = ScholarshipData::where('end_scholarship', '<', now())->get();

        foreach ($expiredScholarships as $scholarship) {
            $userScholarships = UserScholarship::where('scholarship_data_id', $scholarship->id)->get();

            foreach ($userScholarships as $userScholarship) {
                if ($userScholarship->file_path && Storage::disk('public')->exists('file_requirements/' . $userScholarship->file_path)) {
                    Storage::disk('public')->delete('file_requirements/' . $userScholarship->file_path);
                    $userScholarship->file_path = null;
                }

                if ($userScholarship->supervisor_approval_file && Storage::disk('public')->exists('file_requirements/' . $userScholarship->supervisor_approval_file)) {
                    Storage::disk('public')->delete('file_requirements/' . $userScholarship->supervisor_approval_file);
                }
                $userScholarship->supervisor_approval_file = null;

                $userScholarship->save();
            }
        }

        Log::info('Expired files deleted successfully.');
        $this->info('Expired files deleted successfully.');
    }
}
