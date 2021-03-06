<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Tag;

class ArticleController extends Controller
{
    /** @var ArticleRepositoryInterface */
    private $articleRepository;

    /** @var TagRepositoryInterface */
    private $tagRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository, TagRepositoryInterface $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->tagRepository     = $tagRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->all();
        $tags     = $this->tagRepository->all();
        $yearList = $this->articleRepository->yearList();

        return view('article.index', compact('articles', 'tags', 'yearList'));
    }

    public function create()
    {
        $tags = $this->tagRepository->all();
        return view('article.create', compact('tags'));
    }

    public function store(ArticleRequest $request)
    {
        $tag_ids = $request->exists('tag_id') ? $request->input('tag_id') : [];
        $article = $this->articleRepository->create($request->all(), $tag_ids);

        return view('article.store', ['title' => $article->title]);
    }

    public function show(int $id)
    {
        $article  = $this->articleRepository->findOrFail($id);
        $yearList = $this->articleRepository->yearList();
        $tags     = $this->tagRepository->all();
        return view('article.show', compact('article', 'tags', 'yearList'));
    }

    public function edit(int $id)
    {
        $article = $this->articleRepository->findOrFail($id);
        $tags = $this->tagRepository->all();
        return view('article.edit', compact('article', 'tags'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $input    = $request->all();
        $filename = null;

        if ($request->file('image')) {
            $filename = $request->file('image')->store('public/uploads');
        }

        $input['image_path'] = basename($filename);
        $article             = $this->articleRepository->update($article, $input);

        return view('article.update', ['title' => $article->title]);
    }

    public function destroy(Article $article)
    {
        $this->articleRepository->delete($article);
        return view('article.destroy', ['title' => $article->title]);

    }

    public function year($year)
    {
        $articles = $this->articleRepository->showByYear($year);
        $tags     = Tag::all();
        $yearList = $this->articleRepository->yearList();

        return view('article.index', compact('articles', 'tags', 'yearList'));
    }
}
