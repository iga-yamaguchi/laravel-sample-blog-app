<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'image_path'];
    protected $hidden = ['pivot', 'deleted_at', 'user_id'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag_relations', 'article_id', 'tag_id')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get image path on web site.
     *
     * @param $imagePath
     * @return mixed
     */
    public function getAbsoluteImagePathAttribute()
    {
        return Storage::url('public/uploads/' . $this->image_path);
    }
}
