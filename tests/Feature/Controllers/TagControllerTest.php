<?php

namespace Tests\Feature\Controllers;

use App\Tag;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagControllerTest extends TestCase
{
    private $tags;

    public function setUp()
    {
        parent::setUp();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tags')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->tags = factory(Tag::class, 10)->create();
    }

    public function testCreate()
    {
        $tag = factory(Tag::class)->make();

        $this->post('tag', $tag->toArray())
            ->isOk();
        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    public function testUpdate()
    {
        $tag = factory(Tag::class)->make();
        $this->put('tag/' . $this->tags[0]->id, $tag->toArray())
            ->isOk();

        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    public function testDelete()
    {
        $id = $this->tags[0]->id;
        $this->delete('tag/' . $id)
            ->isOk();
        $this->assertDatabaseHas('tags', ['id' => $id])
            ->assertDatabaseMissing('tags', ['id' => $id, 'deleted_at' => null]);
    }

    public function testCreateFromView()
    {
        $this->markTestIncomplete();
    }

    public function testUpdateFromView()
    {
        $this->markTestIncomplete();
    }

    public function testDeleteFromView()
    {
        $this->markTestIncomplete();
    }
}
