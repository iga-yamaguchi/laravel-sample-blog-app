<?php

namespace Tests\Feature\Controllers;

use App\Article;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestUtils\SetupDirectory;

class ArticleControllerTest extends TestCase
{
    private $articles;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->articles = factory(Article::class, 10)->create();
    }

    public function tearDown()
    {
        SetupDirectory::cleanUploads();
        parent::tearDown();
    }

    public function testCreate()
    {
        $article = factory(Article::class)->make();

        // TODO: test sync relation
        $this->post('article', $article->toArray())
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('articles', $article->toArray());
    }

    public function testShow()
    {
        $article = $this->articles[0];
        $this->get('article/' . $article->id)
            ->assertStatus(Response::HTTP_OK);
    }

    public function testUpdate()
    {
        $article = factory(Article::class)->make();
        $this->put('article/' . $this->articles[0]->id, $article->toArray())
            ->assertStatus(Response::HTTP_OK);

        // TODO: test image_path
        $resultOfRemovingImage = $article->toArray();
        unset($resultOfRemovingImage['image_path']);
        $this->assertDatabaseHas('articles', $resultOfRemovingImage);
    }

    public function testDelete()
    {
        $id = $this->articles[0]->id;
        $this->delete('article/' . $id)
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('articles', ['id' => $id])
            ->assertDatabaseMissing('articles', ['id' => $id, 'deleted_at' => null]);
    }
}
