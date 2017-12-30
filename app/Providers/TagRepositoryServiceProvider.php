<?php

namespace App\Providers;

use App\Repositories\TagRepository;
use App\Repositories\TagRepositoryInterface;
use App\Tag;
use Illuminate\Support\ServiceProvider;

class TagRepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton(TagRepositoryInterface::class, function ($app) {
            return new TagRepository(new Tag());
        });
    }
}
