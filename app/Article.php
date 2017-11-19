<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'image_path'];
    protected $hidden = ['pivot'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag_relations', 'article_id', 'tag_id')->withTimestamps();
    }
}
