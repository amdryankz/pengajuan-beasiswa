<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScholarship extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'scholarship_data_id', 'file_requirement_id', 'file_path', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
