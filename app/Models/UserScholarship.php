<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserScholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'scholarship_data_id',
        'file_requirement_id',
        'file_path',
        'file_status',
        'scholarship_status',
        'supervisor_approval_file'
    ];

    /**
     * Get the user that owns the UserScholarship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the scholarshipData that owns the UserScholarship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scholarshipData(): BelongsTo
    {
        return $this->belongsTo(ScholarshipData::class, 'scholarship_data_id', 'id');
    }

    /**
     * Get the files that owns the UserScholarship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function files(): BelongsTo
    {
        return $this->belongsTo(FileRequirement::class, 'file_requirement_id', 'id');
    }
}
