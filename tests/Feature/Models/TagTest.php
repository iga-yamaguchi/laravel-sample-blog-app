<?php

namespace Tests\Feature\Models;

use App\Article;
use App\Tag;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Tests\TestUtils\AssertRelation;

class TagTest extends TestCase
{
    use AssertRelation;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
    }

    public function testArticleRelation()
    {
        $this->assertRelation(Tag::class, Article::class, 'articles');
    }
}
