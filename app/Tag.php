<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany('App\Article', 'article_tag_relations', 'tag_id', 'article_id')->withTimestamps();
    }
}
