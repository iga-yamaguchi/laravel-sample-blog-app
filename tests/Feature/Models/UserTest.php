<?php

namespace Tests\Feature\Models;

use App\Article;
use App\User;
use Illuminate\Support\Facades\Auth;
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
        $user  = factory(User::class)->create();
        $limit = $user->latest_article_limit;

        $user->articles()->saveMany(factory(Article::class, $limit + 5)->make());
        $this->assertEquals($limit, $user->latestArticles->count());
    }

    public function testArticleRelation()
    {
        $this->assertHasMany(User::class, Article::class, 'articles');
    }

    public function testIsSameAuthUserAttribute()
    {
        $loginUser    = factory(User::class)->create();
        $this->actingAs($loginUser);
        $this->assertTrue($loginUser->is_same_auth_user);

        $nonLoginUser = factory(User::class)->create();
        $this->assertFalse($nonLoginUser->is_same_auth_user);
    }
}
