<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Mobile\Article\GetAllByArticleCategoryIdRequest;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articlesRepository;

    public function __construct()
    {
        if (!$this->articlesRepository) {
            $this->articlesRepository = new ArticlesRepository();
        }
    }

    public function getAllByArticleCategoryId(GetAllByArticleCategoryIdRequest $request)
    {
        $articles = $this->articlesRepository->getAllByArticleCategoryId($request->article_category_id, $request);

        return response([
            'msg' => 'Article Successfully Loaded',
            'data' => $articles
        ]);
    }
}
