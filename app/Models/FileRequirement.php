<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FileRequirement extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ],
        ];
    }

    /**
     * The roles that belong to the FileRequirement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(ScholarshipData::class, 'file_scholarship_data', 'file_requirement_id', 'scholarship_data_id');
    }

    /**
     * Get all of the fileScholarships for the FileRequirement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fileScholarships(): HasMany
    {
        return $this->hasMany(FileScholarshipData::class, 'file_requirement_id', 'id');
    }
}
