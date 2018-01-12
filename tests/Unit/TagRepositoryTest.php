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

    /**
     * The attribute that is number of tag factory
     * @var int
     */
    private $tagCount = 10;

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $this->tags       = factory(Tag::class, $this->tagCount)->create();
        $this->repository = new TagRepository();
    }

    public function testAll()
    {
        $tags = $this->repository->withGet();
        $this->assertEquals($this->tagCount, $tags->count());

        foreach ($this->tags as $tag) {
            $this->assertTrue($tags->contains($tag));
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
        $tag       = factory(Tag::class)->create();
        $updateTag = factory(Tag::class)->make();
        $this->repository->update($tag, $updateTag->toArray());

        foreach ($updateTag->attributesToArray() as $key => $value) {
            $this->assertEquals($value, $tag[$key]);
        }
    }

    public function testDelete()
    {
        $tag = factory(Tag::class)->create();
        $this->repository->delete($tag);
        $this->assertNull(Tag::find($tag->id));
    }
}
