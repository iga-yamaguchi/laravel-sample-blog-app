<?php

namespace Tests\Feature\Models;

use App\Article;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Tests\TestUtils\AssertRelation;
use Tests\TestUtils\SetupDirectory;

class ArticleTest extends TestCase
{
    use AssertRelation;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
    }

    public function tearDown()
    {
        SetupDirectory::cleanUploads();
        parent::tearDown();
    }

    public function testTagRelation()
    {
        $this->assertBelongsToMany(Article::class, Tag::class, 'tags');
    }

    public function testUserRelation()
    {
        $this->assertBelongsTo(Article::class, User::class, 'user');
    }
}