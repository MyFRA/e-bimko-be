<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip_nisn', 'role', 'device_id'
    ];
}
