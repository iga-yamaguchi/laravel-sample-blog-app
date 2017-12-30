<?php

namespace App\Repositories;


use App\Tag;

class TagRepository implements TagRepositoryInterface
{
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function all()
    {
        return Tag::with('articles')->get();
    }
}