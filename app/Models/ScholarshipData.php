<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipData extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'scholarships_id',
        'year',
        'value',
        'status_value',
        'duration',
        'start_regis_at',
        'end_regis_at',
        'min_ipk',
        'kuota',
        'no_sk',
        'file_sk',
        'start_scholarship',
        'end_scholarship',
        'list_student_file',
    ];

    protected $casts = [
        'start_regis_at' => 'date',
        'end_regis_at' => 'date',
        'start_scholarship' => 'date',
        'end_scholarship' => 'date',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ],
        ];
    }

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class, 'scholarships_id');
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
