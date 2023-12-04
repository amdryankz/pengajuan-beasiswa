<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRequirement extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    public function scholarships()
    {
        return $this->belongsToMany(ScholarshipData::class, 'require_files', 'file_requirement_id', 'scholarship_data_id');
    }

    public function requireFiles()
    {
        return $this->hasMany(RequireFile::class, 'file_requirement_id');
    }
}
