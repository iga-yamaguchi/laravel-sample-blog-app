<?php

namespace App\Providers;

use App\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ArticleRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ArticleRepositoryInterface::class, function ($app) {
            return new ArticleRepository();
        });
    }
}
