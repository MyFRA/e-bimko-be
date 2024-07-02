<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Http\Controllers\Controller;
use App\Repositories\ArticleCategoryRepository;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    private $articleCategoryRepository;

    public function __construct()
    {
        if (!$this->articleCategoryRepository) {
            $this->articleCategoryRepository = new ArticleCategoryRepository();
        }
    }

    public function get()
    {
        return response()->json([
            'msg' => 'Article Categories data successfully loaded',
            'data' => $this->articleCategoryRepository->getAll()
        ]);
    }
}
