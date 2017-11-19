<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = ['name'];
    protected $hidden = ['pivot'];

    public function articles()
    {
        return $this->belongsToMany('App\Article', 'article_tag_relations', 'tag_id', 'article_id');
    }
}
