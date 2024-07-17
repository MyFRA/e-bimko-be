<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Article\StoreRequest;
use App\Http\Requests\Panel\Article\UpdateRequest;
use App\Repositories\ArticleCategoryRepository;
use App\Repositories\ArticlesRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    private $articleRepository;

    private $articleCategoryRepository;

    public function __construct()
    {
        if (!$this->articleRepository) {
            $this->articleRepository = new ArticlesRepository();
        }

        if (!$this->articleCategoryRepository) {
            $this->articleCategoryRepository = new ArticleCategoryRepository();
        }
    }

    public function index()
    {
        $data = [
            'articles' => $this->articleRepository->getAllWithPaginationForAdminPanel()
        ];

        return view('panel.pages.articles.index', $data);
    }

    public function create()
    {
        $data = [
            'articleCategories' => $this->articleCategoryRepository->getAll()
        ];

        return view('panel.pages.articles.create', $data);
    }

    public function store(StoreRequest $request)
    {
        $this->articleRepository->create($request);

        return redirect('/panel/articles')->with('success', 'Data artikel telah ditambahkan');
    }

    public function edit($articleId)
    {
        $article = $this->articleRepository->findById($articleId);

        if (!$article) {
            return abort(404);
        }

        $data = [
            'articleCategories' => $this->articleCategoryRepository->getAll(),
            'article' => $this->articleRepository->findById($articleId)
        ];

        return view('panel.pages.articles.edit', $data);
    }

    public function update(UpdateRequest $request, $articleId)
    {
        $article = $this->articleRepository->findById($articleId);

        if (!$article) {
            return abort(404);
        }
        $this->articleRepository->updateByArticleObj($article, $request);

        return redirect('/panel/articles')->with('success', 'Data artikel telah diupdate');
    }

    public function destroy($articleId)
    {
        $article = $this->articleRepository->findById($articleId);

        if (!$article) {
            return abort(404);
        }

        $this->articleRepository->deleteByArticleObj($article);

        return redirect('/panel/articles')->with('success', 'Data artikel telah dihapus');
    }
}
