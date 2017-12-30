<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\TagRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\TagRepository;
use App\Repositories\TagRepositoryInterface;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /** @var TagRepositoryInterface */
    private $tagRepository;

    /** @var ArticleRepositoryInterface */
    private $articleRepository;

    public function __construct(TagRepositoryInterface $tagRepository, ArticleRepositoryInterface $articleRepository)
    {
        $this->tagRepository     = $tagRepository;
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = $this->tagRepository->withGet();
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->all());
        return view('tag.store', ['name' => $tag->name]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        $articles = $tag->articles;
        $tags     = $this->tagRepository->all();
        $yearList = $this->articleRepository->yearList();

        return view('article.index', compact('articles', 'tags', 'yearList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tag.create', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TagRequest $request
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $this->tagRepository->update($tag, $request->all());
        return view('tag.update', ['name' => $tag->name]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $this->tagRepository->delete($tag);
        return view('tag.destroy', ['name' => $tag->name]);
    }
}
