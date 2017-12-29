<?php

namespace Tests\Unit;

use App\Article;
use App\Repositories\ArticleRepository;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleRepositoryTest extends TestCase
{
    /**
     * @var array
     */
    protected $articleArray;

    /**
     * @var Article
     */
    protected $article;

    /**
     * @var ArticleRepository
     */
    protected $repository;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');

        $this->articleArray = [
            'title'      => 'Title1',
            'content'    => 'Content1',
            'image_path' => 'Image path1',
        ];

        Article::create($this->articleArray);

        $this->article    = new Article();
        $this->repository = new ArticleRepository($this->article);
    }

    public function testAll()
    {
        $articleCollections = $this->repository->all();

//        echo 'image: ' . $articleCollections[0]->absolute_image_path;
        echo 'image: ' . $articleCollections[0]->a;
        $this->assertEquals([$this->articleArray], $articleCollections->toArray());
    }
}
