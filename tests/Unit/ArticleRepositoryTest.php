<?php

namespace Tests\Unit;

use App\Article;
use App\Repositories\ArticleRepository;
use App\Tag;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleRepositoryTest extends TestCase
{
    /**
     * @var Collection
     */
    protected $articles;

    /**
     * @var ArticleRepository
     */
    protected $repository;

    private $articleCount = 10;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->articles   = factory(Article::class, $this->articleCount)->create();
        $this->repository = new ArticleRepository();
    }

    public function testAll()
    {
        $articleCollections = $this->repository->all();
        $this->assertEquals($this->articleCount, $articleCollections->count());

        foreach ($this->articles as $article) {
            $this->assertTrue($articleCollections->contains($article));
        }
    }

    public function testCreate()
    {
        /** @var Article $createdArticle */
        $createdArticle = factory(Article::class)->make();
        /** @var Collection $tagIds */
        $tags    = factory(Tag::class, 10)->create();
        $article = $this->repository->create($createdArticle->toArray(), $tags->pluck('id')->toArray());

        foreach ($createdArticle->attributesToArray() as $key => $value) {
            $this->assertEquals($value, $article[$key]);
        }
    }

    public function testUpdate()
    {
        $article        = $this->articles[0];
        $updateData     = factory(Article::class)->make();
        $updatedArticle = $this->repository->update($article, $updateData->toArray());

        foreach ($updateData->attributesToArray() as $key => $value) {
            $this->assertEquals($value, $updatedArticle[$key]);
        }
    }

    public function testFind()
    {
        $article       = $this->articles[0];
        $findedArticle = $this->repository->find($article->id);
        $this->assertEquals($article->id, $findedArticle->id);
    }

    public function testDelete()
    {
        $article = $this->articles[0];
        $this->repository->delete($article);
        $this->assertNull(Article::find($article->id));
    }

    public function testShowByYear()
    {
        $this->markTestIncomplete();
    }

    public function testYearList()
    {
        $this->markTestIncomplete();
    }
}
