<?php

namespace Tests\Unit;

use App\Repositories\TagRepository;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagRepositoryTest extends TestCase
{
    /** @var Collection */
    private $tags;

    /** @var TagRepository */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->tags       = factory(Tag::class, 10)->create();
        $this->repository = new TagRepository(new Tag());
    }

    public function testAll()
    {
        $tags = $this->repository->withGet();

        foreach ($this->tags as $key => $tag) {
            $this->assertEquals($tag->id, $tags[$key]->id);
        }
    }

    public function testCreate()
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->make();

        /** @var Tag $tag */
        $createdTag = $this->repository->create($tag->toArray());

        foreach ($tag->attributesToArray() as $key => $value) {
            $this->assertEquals($value, $createdTag[$key]);
        }
    }

    public function testUpdate()
    {
        /** @var Tag $tag */
        $tag = factory(Tag::class)->create();
        $updateTag = factory(Tag::class)->make();
        $this->repository->update($tag, $updateTag->toArray());

        foreach ($updateTag->attributesToArray() as $key => $value){
            $this->assertEquals($value, $tag[$key]);
        }
    }

    public function testDelete()
    {
        $tag = factory(Tag::class)->create();
        $this->repository->delete($tag->id);
        $this->assertNull(Tag::find($tag->id));
    }
}
