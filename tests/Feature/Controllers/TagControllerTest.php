<?php

namespace Tests\Feature\Controllers;

use App\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestUtils\SetupDirectory;

class TagControllerTest extends TestCase
{
    private $tags;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->tags = factory(Tag::class, 10)->create();
    }

    public function tearDown()
    {
        SetupDirectory::cleanUploads();
        parent::tearDown();
    }

    public function testCreate()
    {
        $tag = factory(Tag::class)->make();

        $this->post('tag', $tag->toArray())
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    public function testUpdate()
    {
        $tag = factory(Tag::class)->make();
        $this->put('tag/' . $this->tags[0]->id, $tag->toArray())
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('tags', $tag->toArray());
    }

    public function testDelete()
    {
        $id = $this->tags[0]->id;
        $this->delete('tag/' . $id)
            ->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('tags', ['id' => $id])
            ->assertDatabaseMissing('tags', ['id' => $id, 'deleted_at' => null]);
    }
}
