<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nim',
        'password',
        'prodi',
        'fakultas',
        'jk',
        'ipk',
        'total_sks',
        'birthdate',
        'birthplace',
        'address',
        'name_parent',
        'job_parent',
        'income_parent',
        'no_hp',
        'no_rek',
        'name_rek',
        'name_bank',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birthdate' => 'date',
    ];

    public function scholarships()
    {
        return $this->belongsToMany(ScholarshipData::class, 'user_scholarships', 'user_id', 'scholarship_data_id')->withPivot(['status_file', 'status_scholar']);
    }
}
