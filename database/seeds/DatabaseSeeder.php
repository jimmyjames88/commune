<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(PostsTableSeeder::class);
        // $this->call(CommentsTableSeeder::class);
        // $this->call(ProfilesTableSeeder::class);
        // $this->call(FollowersTableSeeder::class);   // no factory
        // $this->call(LikesTableSeeder::class);

    }
}
