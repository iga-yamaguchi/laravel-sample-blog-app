<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderby('created_at', 'desc')->get();
        $tags     = Tag::all();

        return view('article.index', compact('articles', 'tags'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('article.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $article = Article::create($request->all());

        DB::transaction(function () use ($article, $request) {
            $tag_ids = $request->exists('tag_id') ? $request->input('tag_id') : [];
            $article->tags()->sync($tag_ids);
        });

        return view('article.store', ['title' => $article->title]);
    }

    public function show(Article $article)
    {
        $tags = Tag::all();
        return view('article.show', compact('article', 'tags'));
    }

    public function edit(Article $article)
    {
        $tags = Tag::all();
        return view('article.create', compact('article', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        DB::transaction(function () use ($article, $request) {
            $tag_ids = $request->exists('tag_id') ? $request->input('tag_id') : [];
            $article->tags()->sync($tag_ids);
        });

        return view('article.update', ['title' => $article->title]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return view('article.destroy', ['title' => $article->title]);

    }
}
