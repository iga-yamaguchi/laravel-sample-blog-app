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

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithTags($query)
    {
        return $query->with([
            'tags' => function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->select('name');
            }]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUser($query)
    {
        return $query->with([
            'user' => function ($query) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->select('id', 'name', 'user_id');
            },
        ]);
    }
}
