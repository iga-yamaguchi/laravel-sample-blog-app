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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('articles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        factory(Article::class, 10)->create()->each(function ($article) {
            $article->tags()->save(factory(Tag::class)->make());

        });
    }
}
