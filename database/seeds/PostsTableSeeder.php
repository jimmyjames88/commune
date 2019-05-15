<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $GLOBALS['postCount'] = (int)$this->command->ask('How many posts?');
        $this->command->info('Generating ' . $GLOBALS['postCount'] . ' Posts');
        $posts = factory(App\Post::class, $GLOBALS['postCount'])->create();
        $this->command->info('Posts created!');
    }
}
