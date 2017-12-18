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
        factory(App\Tag::class, 15)->create();
    }
}
