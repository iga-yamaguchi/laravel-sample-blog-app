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
        $articles = factory(Article::class, 1)->make();

        $this->post('article', $articles[0]->toArray())
            ->assertStatus(200);
        $this->assertDatabaseHas('articles', $articles[0]->toArray());
    }

    public function testUpdate()
    {
        $this->markTestIncomplete();
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
