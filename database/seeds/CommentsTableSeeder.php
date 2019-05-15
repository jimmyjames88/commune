<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $GLOBALS['commentCount'] = (int)$this->command->ask('How many Comments?');
        $this->command->info('Generating ' . $GLOBALS['commentCount'] . ' Comments');
        factory(App\Comment::class, $GLOBALS['commentCount'])->create();
        $this->command->info('Comments created!');
    }
}
