<?php

namespace Tests\Unit;

use App\Article;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Article::create([
            'title' => 'Title1',
            'content' => 'Content1',
            'image_path' => 'Image path1',
        ]);
    }

    public function testAll()
    {
    }
}
