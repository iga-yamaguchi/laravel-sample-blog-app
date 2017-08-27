<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $tags     = Tag::all();

        return view('article.index', compact('articles', 'tags'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());
        return view('article.store', ['title' => $article->title]);
    }

    public function show(Article $article)
    {
        $tags = Tag::all();
        return view('article.show', compact('article', 'tags'));
    }

    public function edit(Article $article)
    {
        return view('article.create', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return view('article.update', ['title' => $article->title]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return view('article.destroy', ['title' => $article->title]);

    }
}
