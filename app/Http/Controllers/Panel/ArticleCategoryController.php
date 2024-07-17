<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ArticleCategory\UpdateRequest;
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

    public function index()
    {
        $data = [
            'articleCategories' => $this->articleCategoryRepository->getAll()
        ];

        return view('panel.pages.article-categories.index', $data);
    }

    public function edit($articleCategoryId)
    {
        $articleCategory = $this->articleCategoryRepository->findById($articleCategoryId);

        if (!$articleCategory) {
            return abort(404);
        }

        $data = [
            'articleCategory' => $articleCategory
        ];

        return view('panel.pages.article-categories.edit', $data);
    }

    public function update(UpdateRequest $request, $articleCategoryId)
    {
        $articleCategory = $this->articleCategoryRepository->findById($articleCategoryId);

        if (!$articleCategory) {
            return abort(404);
        }

        $this->articleCategoryRepository->updateByArticleCategoryObj($articleCategory, $request);

        return redirect('/panel/article-categories')->with('success', 'Data kategori artikel telah diupdate');
    }
}
