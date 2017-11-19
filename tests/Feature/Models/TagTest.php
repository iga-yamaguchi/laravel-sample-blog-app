<?php

namespace Tests\Feature\Models;

use App\Article;
use App\Tag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
    }

    public function testArticleRelation()
    {
        $articles = factory(Article::class, 3)->create();
        $tag    = factory(Tag::class)->create();

        $ids = $articles->pluck('id');
        $tag->articles()->attach($ids);

        $this->assertEquals($articles->count(), $tag->articles->count());

        foreach ($tag->articles as $key => $article) {
            $articleArray = $articles[$key]->toArray();

            $this->assertEquals($article->toArray(), $articleArray);
        }
    }
}
