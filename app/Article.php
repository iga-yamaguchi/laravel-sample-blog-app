<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'image_path', 'absolute_image_path'];
    protected $hidden = ['pivot', 'deleted_at', 'image_path'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag_relations', 'article_id', 'tag_id')->withTimestamps();
    }

    /**
     * Get image path on web site.
     *
     * @param $imagePath
     * @return mixed
     */
    public function getAbsoluteImagePathAttribute($imagePath)
    {
        return Storage::url('public/uploads/' . $imagePath);
    }
}
