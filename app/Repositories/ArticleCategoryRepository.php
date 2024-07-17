<?php

namespace App\Repositories;

use App\Models\ArticleCategory;

class ArticleCategoryRepository
{

    public function getAll()
    {
        return ArticleCategory::orderBy('id', 'ASC')->get();
    }

    public function findById($articleCategoryId)
    {
        return ArticleCategory::find($articleCategoryId);
    }

    public function updateByArticleCategoryObj($articleCategory, $request)
    {
        $articleCategory->update([
            'name' => $request->name,
        ]);

        return $articleCategory;
    }
}
