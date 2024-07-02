<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_category_id', 'title', 'slug', 'thumbnail', 'content'
    ];

    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? url('/storage/articles/thumbnail/' . $this->thumbnail) : null;
    }
}
