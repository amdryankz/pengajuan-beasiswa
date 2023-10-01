<?php

namespace App\Models;

use App\Models\User;
use App\Models\Donor;
use App\Models\FileRequirement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScholarshipData extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'donors_id',
        'status_scholarship',
        'value',
        'status_value',
        'duration',
        'start_regis_at',
        'end_regis_at',
        'min_ipk',
        'start_graduation_at',
        'end_graduation_at',
        'kuota',
        'no_sk',
        'file_sk'
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donors_id');
    }

    public function requirements()
    {
        return $this->belongsToMany(FileRequirement::class, 'require_files', 'scholarship_data_id', 'file_requirement_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_scholarships', 'scholarship_data_id', 'user_id');
    }
}
