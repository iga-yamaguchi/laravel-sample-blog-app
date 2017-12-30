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
        $this->tags = factory(Tag::class, 10)->create();
        $this->repository = new TagRepository(new Tag());
    }

    public function testAll()
    {
        $tags = $this->repository->all();

        foreach ($this->tags as $key => $tag) {
            $this->assertEquals($tag->id, $tags[$key]->id);
        }
    }
}
