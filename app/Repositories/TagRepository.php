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

    public function withGet()
    {
        return $this->tag->with('articles')->get();
    }

    public function create(array $data)
    {
        return $this->tag->create($data);
    }

    public function all()
    {
        return $this->tag->all();
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

    function delete(string $id)
    {
        $tag = $this->tag->find($id);
        return $tag->delete();
    }
}