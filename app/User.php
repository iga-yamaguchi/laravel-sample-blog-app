<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attiribute that is used to display the latest article.
     *
     * @var int
     */
    protected $latest_article_limit = 5;

    public function getRouteKeyName()
    {
        return 'user_id';
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function getCreatedAtAttribute($createdAt)
    {
        return date('Y-m-d', strtotime($createdAt));
    }

    public function getLatestArticleLimitAttribute()
    {
        return $this->latest_article_limit;
    }

    public function getLatestArticlesAttribute()
    {
        return $this->articles()->orderBy('created_at')->limit($this->latest_article_limit)->get();
    }
}
