<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ['name', 'donors_id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ],
        ];
    }

    public function donors()
    {
        return $this->belongsTo(Donor::class, 'donors_id');
    }

    public function scholarshipData()
    {
        return $this->hasMany(ScholarshipData::class, 'scholarships_id');
    }
}
