<?php

namespace Tests\Feature\Models;

use App\Article;
use App\Tag;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::table('tags')->truncate();
        DB::table('article_tag_relations')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
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
            $tagArray['deleted_at'] = null;

            $this->assertEquals($tag->toArray(), $tagArray);
        }

    }
}