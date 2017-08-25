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
        $tags = Tag::all();

        return view('article.index', compact('articles', 'tags'));
    }
}
