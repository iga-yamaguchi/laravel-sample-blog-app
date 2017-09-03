<?php

namespace Tests\Feature\Controllers;

use App\Article;
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
        $this->articles = factory(Article::class, 10)->create();
    }

    public function testDeleteFromView()
    public function testDelete()
    {
        $id = $this->articles[0]->id;
        $this->delete('article/' . $id)
            ->assertStatus(200);
        $this->assertDatabaseHas('articles', ['id' => $id])
            ->assertDatabaseMissing('articles', ['id' => $id, 'deleted_at' => null]);
    }
}
