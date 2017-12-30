<?php

namespace App\Repositories;

use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function all()
    {
        return Article::orderBy('created_at', 'desc')->get();
    }

    public function create(array $data, array $tags)
    {
        $article = Article::create($data);

        DB::transaction(function () use ($article, $tags) {
            $tag_ids = count($tags) > 0 ? $tags : [];
            $article->tags()->sync($tag_ids);
        });

        return $article;
    }

    public function update(Article $article, array $data)
    {
        $article->update($data);
        DB::transaction(function () use ($article, $data) {
            $tag_ids = isset($data['tag_id']) ? $data['tag_id'] : [];
            $article->tags()->sync($tag_ids);
        });

        return $article;
    }

    public function find(int $id)
    {
        return Article::find($id);
    }

    public function delete(Article $article)
    {
        return $article->delete();
    }

    public function showByYear($year = null)
    {
        $articles = Article::whereYear('created_at', $year)->get();
        return $articles;
    }

    public function yearList()
    {
        return Article::select('created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($d) {
                return Carbon::parse($d->created_at)->format('Y');
            });
    }
}