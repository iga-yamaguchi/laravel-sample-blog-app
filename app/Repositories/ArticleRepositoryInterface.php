<?php

namespace App\Repositories;

interface ArticleRepositoryInterface
{
    function all();

    function create(array $data, array $tags);

    function update(int $id, array $data);

    function showByYear($year);

    function yearList();
}