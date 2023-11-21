<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScholarship extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'scholarship_data_id', 'file_requirement_id', 'file_path', 'status_file', 'status_scholar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scholarshipData()
    {
        return $this->belongsTo(ScholarshipData::class, 'scholarship_data_id');
    }

    public function files()
    {
        return $this->belongsTo(FileRequirement::class, 'file_requirement_id');
    }
}
