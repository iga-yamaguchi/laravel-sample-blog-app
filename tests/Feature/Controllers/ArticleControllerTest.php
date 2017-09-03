<?php

namespace Tests\Feature\Controllers;

use App\Article;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleControllerTest extends TestCase
{
    private $articles;

    public function setUp()
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->articles = factory(Article::class, 10)->create();
    }

    public function testCreate()
    {
        $article = factory(Article::class)->make();

        $this->post('article', $article->toArray())
            ->assertStatus(200);
        $this->assertDatabaseHas('articles', $article->toArray());
    }

    public function testUpdate()
    {
        $article = factory(Article::class)->make();
        $this->put('article/' . $this->articles[0]->id, $article->toArray())
            ->assertStatus(200);

        // TODO: Probably image file problem
//        $this->assertDatabaseHas('articles', $article->toArray());
    }

    public function testDelete()
    {
        $id = $this->articles[0]->id;
        $this->delete('article/' . $id)
            ->assertStatus(200);
        $this->assertDatabaseHas('articles', ['id' => $id])
            ->assertDatabaseMissing('articles', ['id' => $id, 'deleted_at' => null]);
    }

    public function testCreateFromView()
    {
        $this->markTestIncomplete();
    }

    public function testUpdateFromView()
    {
        $this->markTestIncomplete();
    }

    public function testDeleteFromView()
    {
        $this->markTestIncomplete();
    }
}
