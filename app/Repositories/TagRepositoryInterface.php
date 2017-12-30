<?php
/**
 * Created by PhpStorm.
 * User: yamasa
 * Date: 2017/12/30
 * Time: 16:50
 */

namespace App\Repositories;


use App\Tag;

interface TagRepositoryInterface
{
    function withGet();

    function create(array $data);

    function all();

    function update(Tag $tag, array $data);

    function delete(Tag $tag);
}