<?php

namespace App\Repositories;

use App\Article;

interface ArticleRepositoryInterface
{
    function all();

    function create(array $data, array $tags);

    function update(Article $article, array $data);

    function find(int $id);

    function delete(Article $article);

    function showByYear($year);

    function yearList();
}