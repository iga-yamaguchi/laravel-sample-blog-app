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

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->articles   = factory(Article::class, 10)->create();
        $this->repository = new ArticleRepository(new Article());
    }

    # TODO: Sometime the ids is different for some reason.
    public function testAll()
    {
        $articleCollections = $this->repository->all();

        foreach ($articleCollections as $key => $article) {
            /** @var $article Article */
            $this->assertEquals($this->articles[$key]->id, $article->id);
        }
    }

    public function testCreate()
    {
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
        $article = $this->articles[0];
        $updateData = factory(Article::class)->make();
        $updatedArticle = $this->repository->update($article->id, $updateData->toArray());

        foreach ($updateData->attributesToArray() as $key => $value) {
            $this->assertEquals($value, $updatedArticle[$key]);
        }
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
