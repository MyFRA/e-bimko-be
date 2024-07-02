<?php

namespace App\Repositories;

use App\Models\Article;

class ArticlesRepository
{

    public function getAllByArticleCategoryId($articleCategoryId)
    {
        return Article::where('article_category_id', $articleCategoryId)->orderBy('created_at', 'DESC')->get();
    }
}
