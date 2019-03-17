<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function run()
     {
         $GLOBALS['likeCount'] = (int)$this->command->ask('How many Likes?');
         $this->command->info('Generating ' . $GLOBALS['likeCount'] . ' Likes');
         factory(App\Like::class, $GLOBALS['likeCount'])->create();
         $this->command->info('Likes created!');
    }
}
