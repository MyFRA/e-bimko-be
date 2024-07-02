<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn', 'name', 'gender', 'dob', 'profile_pict', 'device_id'
    ];

    protected $appends = ['profile_pict_url'];

    public function getProfilePictUrlAttribute()
    {
        return $this->profile_pict ? url('/storage/students/profile-pict/' . $this->profile_pict) : null;
    }
}
