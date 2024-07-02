<?php

namespace App\Repositories;

use App\Models\ArticleCategory;

class ArticleCategoryRepository
{

    public function getAll()
    {
        return ArticleCategory::orderBy('id', 'ASC')->get();
    }
}
