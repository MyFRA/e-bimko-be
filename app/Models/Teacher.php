<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'photo', 'role'
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? url('/storage/teachers/photo/' . $this->photo) : null;
    }
}
