<?php

namespace App\Repositories;

use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Article::with([
            'tags' => function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->select('name');
            },
            'user' => function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->select('id', 'name', 'user_id');
            },
        ])
            ->orderBy('created_at', 'desc')->get(['id', 'title', 'content', 'image_path', 'created_at', 'user_id']);
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