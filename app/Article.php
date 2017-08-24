<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag_relations', 'article_id', 'tag_id')->withTimestamps();
    }
}
