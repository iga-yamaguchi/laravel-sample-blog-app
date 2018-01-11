<?php

namespace Tests\Feature\Models;

use App\Article;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestUtils\AssertRelation;

class UserTest extends TestCase
{
    use AssertRelation;

    public function testArticleInUserPage()
    {
        $user = factory(User::class)->create();
    }

    public function testArticleRelation()
    {
        $this->assertHasMany(User::class, Article::class, 'articles');
    }
}
