<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScholarshipData extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scholarships_id',
        'year',
        'amount',
        'amount_period',
        'duration',
        'start_registration_at',
        'end_registration_at',
        'min_ipk',
        'quota',
        'sk_number',
        'sk_file',
        'start_scholarship',
        'end_scholarship'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_registration_at' => 'date',
        'end_registration_at' => 'date',
        'start_scholarship' => 'date',
        'end_scholarship' => 'date'
    ];

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
     * Get the scholarship that owns the ScholarshipData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scholarship(): BelongsTo
    {
        return $this->belongsTo(Scholarship::class, 'scholarships_id', 'id');
    }

    /**
     * The requirements that belong to the ScholarshipData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requirements(): BelongsToMany
    {
        return $this->belongsToMany(FileRequirement::class, 'file_scholarship_data', 'scholarship_data_id', 'file_requirement_id');
    }

    /**
     * The users that belong to the ScholarshipData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_scholarships', 'scholarship_data_id', 'user_id');
    }
}
