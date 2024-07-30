<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionBox extends Model
{
    use HasFactory;

    protected $fillable = ['suggestion'];
}
