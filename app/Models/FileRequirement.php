<?php

namespace App\Models;

use App\Models\ScholarshipData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function scholarships()
    {
        return $this->belongsToMany(ScholarshipData::class, 'require_files', 'file_requirement_id', 'scholarship_data_id');
    }

    public function requireFiles()
    {
        return $this->hasMany(RequireFile::class, 'file_requirement_id');
    }
}
