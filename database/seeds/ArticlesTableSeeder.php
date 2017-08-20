<?php

use App\Article;
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
        DB::table('articles')->delete();
        $faker = Faker\Factory::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            Article::create([
                'title'      => $faker->title,
                'content'    => $faker->text(191),
                'image_path' => $faker->imageUrl(),
            ]);
        }
    }
}
