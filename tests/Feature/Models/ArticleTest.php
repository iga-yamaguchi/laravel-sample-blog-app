<?php

namespace Tests\Feature\Models;

use App\Article;
use App\Tag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
    }

    public function testTagRelation()
    {
        $tags    = factory(Tag::class, 3)->create();
        $article = factory(Article::class)->create();

        $ids = $tags->pluck('id');
        $article->tags()->attach($ids);

        $this->assertEquals($tags->count(), $article->tags->count());

        foreach ($article->tags as $key => $tag) {
            $tagArray = $tags[$key]->toArray();

            $this->assertEquals($tag->toArray(), $tagArray);
        }

    }
}