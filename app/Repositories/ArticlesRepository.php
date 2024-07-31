<?php

namespace App\Repositories;

use App\Helpers\ModelFileUploadHelper;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticlesRepository
{

    public function getAllByArticleCategoryId($articleCategoryId, $request)
    {
        return Article::select('title', 'slug', 'thumbnail', 'created_at', DB::raw('DATE(created_at) as date'), 'content')->where('article_category_id', $articleCategoryId)->orderBy('created_at', 'DESC')->paginate(
            $request->size ? $request->size : 10, // per page (may be get it from request)
            ['*'], // columns to select from table (default *, means all fields)
            'page', // page name that holds the page number in the query string
            $request->page ? $request->page : 1 // current page, default 1
        );
    }

    public function getAllWithPaginationForAdminPanel()
    {
        return Article::paginate(10);
    }

    public function findById($articleId)
    {
        return Article::find($articleId);
    }

    public function create($request)
    {
        $article = Article::create([
            'article_category_id' => $request->article_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . rand(1000, 9999),
            'thumbnail' => ModelFileUploadHelper::modelFileStore('articles', 'thumbnail', $request->file('thumbnail')),
            'content' => $request->content,
        ]);

        return $article;
    }

    public function updateByArticleObj($articleObj, $request)
    {
        $articleObj->update([
            'article_category_id' => $request->article_category_id,
            'title' => $request->title,
            'thumbnail' => ModelFileUploadHelper::modelFileUpdate($articleObj, 'thumbnail', $request->file('thumbnail')),
            'content' => $request->content,
        ]);

        return $articleObj;
    }

    public function deleteByArticleObj($articleObj)
    {
        ModelFileUploadHelper::modelFileDelete($articleObj, 'thumbnail');
        $articleObj->delete();
    }
}
