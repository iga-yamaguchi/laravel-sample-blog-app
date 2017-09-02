<?php
namespace App\Repositories;

use App\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleRepository
{
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function all()
    {
        return $this->article->orderby('created_at', 'desc')->get();
    }

    public function create($request)
    {
        $article = $this->article->create($request->all());

        DB::transaction(function () use ($article, $request) {
            $tag_ids = $request->exists('tag_id') ? $request->input('tag_id') : [];
            $article->tags()->sync($tag_ids);
        });

        return $article;
    }

    public function update($id, $data)
    {
        $article = $this->article->find($id);

        $article->update($data);
        DB::transaction(function () use ($article, $data) {
            $tag_ids = isset($data['tag_id']) ? $data['tag_id'] : [];
            $article->tags()->sync($tag_ids);
        });

        return $article;
    }

    public function showByYear($year = null)
    {
        $articles = $this->article->whereYear('created_at', $year)->get();
//        dd($articles->get()->toArray());
        return $articles;
    }

    public function yearList()
    {
        return $this->article
            ->select('created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($d) {
                return Carbon::parse($d->created_at)->format('Y');
            });
    }
}