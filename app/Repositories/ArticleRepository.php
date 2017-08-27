<?php
namespace App\Repositories;

use App\Article;
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
}