<?php

namespace Tests\Feature\Models;

use App\Article;
use App\Tag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Tests\TestUtils\TestRelation;

class ArticleTest extends TestCase
{
    use TestRelation;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
    }

    public function testTagRelation()
    {
        $this->assertRelation(Article::class, Tag::class, 'tags');
    }
}