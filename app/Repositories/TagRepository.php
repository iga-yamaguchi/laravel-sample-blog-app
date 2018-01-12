<?php

namespace App\Repositories;


use App\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function withGet()
    {
        return Tag::with('articles')->get();
    }

    public function create(array $data)
    {
        return Tag::create($data);
    }

    public function all()
    {
        return Tag::all();
    }

    /**
     * @param Tag $tag
     * @param array $data
     * @return bool
     */
    function update(Tag $tag, array $data)
    {
        return $tag->update($data);
    }

    function delete(Tag $tag)
    {
        return $tag->delete();
    }
}