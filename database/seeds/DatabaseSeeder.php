<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Artisan::call('migrate:refresh');
        $this->call(TagsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
    }
}
