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

    }

    public function show(Article $article)
    {
        $tags = Tag::all();
        return view('article.show', compact('article', 'tags'));
    }

    public function edit(Article $article)
    {

    }

    public function update(Request $request, Article $article)
    {

    }

    public function destroy(Article $article)
    {

    }
}
