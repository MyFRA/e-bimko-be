<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile_user_id', 'name', 'gender', 'dob', 'profile_pict', 'role'
    ];

    protected $appends = ['profile_pict_url'];

    public function getProfilePictUrlAttribute()
    {
        return $this->profile_pict ? url('/storage/teachers/profile-pict/' . $this->profile_pict) : null;
    }

    public function mobileUser()
    {
        return $this->belongsTo(MobileUser::class);
    }
}
