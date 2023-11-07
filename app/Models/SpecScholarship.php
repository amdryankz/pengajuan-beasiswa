<?php

namespace App\Models;

use App\Models\ScholarshipData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpecScholarship extends Model
{
    use HasFactory;

    protected $fillable = ['scholarship_data_id', 'list_students'];

    public function scholarships(): BelongsTo
    {
        return $this->belongsTo(ScholarshipData::class, 'scholarship_data_id', 'id');
    }
}
