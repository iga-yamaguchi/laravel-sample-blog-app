<?php

use App\Article;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 15)->create()->each(function ($article) {
            $article->tags()->save(factory(Tag::class)->make());
        });
    }
}
