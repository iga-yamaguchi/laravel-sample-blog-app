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
        DB::table('tags')->delete();
        $faker = Faker\Factory::create('en_US');

        for ($i = 0; $i < 10; $i++) {
            Tag::create([
                'name' => $faker->word
            ]);
        }
    }
}
