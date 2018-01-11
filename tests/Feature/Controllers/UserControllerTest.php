<?php

namespace Tests\Feature\Controllers;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
    public function testShowUserPage()
    {
        /** @var User $user */
        $user = factory(User::class)->create();
        $user->wasRecentlyCreated = false;

        $this->get('user/' . $user->name)
            ->assertStatus(Response::HTTP_OK)
            ->assertViewIs('home')
            ->assertViewHas('user', $user);
    }
}
