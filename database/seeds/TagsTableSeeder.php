<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tags')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        factory(App\Tag::class, 10)->create();
    }
}
