<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = (int)$this->command->ask('How many users?');

        $users = factory(App\User::class, $userCount)
                    ->create()
                    ->each(function($user) use ($userCount) {
                        // factory(App\Conversation::class, mt_rand(1, 5))
                        //     ->create()
                        //     ->each(function($conversation) use ($user) {
                        //         $conversation->messages()->saveMany(
                        //             factory(App\Message::class, mt_rand(2, 10))
                        //                 ->make(['user_id' => $user->id ])
                        //         );
                        //     });
                        factory(App\Profile::class)
                            ->create([ 'user_id' => $user->id ]);
                        factory(App\Post::class, 5)
                            ->create(['user_id'   =>  $user->id])
                            ->each(function($post) use ($user, $userCount){
                                echo '...';
                                factory(App\Comment::class, 5)
                                    ->create([
                                        'user_id' => $user->id,
                                        'post_id' => $post->id
                                    ])
                                    ->each(function($comment) use ($userCount) {
                                        for ($x = 1; $x < $userCount; $x++){
                                            if(mt_rand(0, 2) === 2) {
                                                factory(App\Like::class)
                                                    ->create([
                                                        'likeable_type' => 'App\Comment',
                                                        'likeable_id' => $comment->id,
                                                        'user_id' => $x
                                                    ]);
                                            }

                                        }
                                    });

                                for ($x = 1; $x < $userCount; $x++){
                                    if(mt_rand(0, 2) === 2) {
                                        factory(App\Like::class)
                                            ->create([
                                                'likeable_type' => 'App\Post',
                                                'likeable_id' => $post->id,
                                                'user_id' => $x
                                            ]);
                                    }

                                }

                            });
                    });

        // followers
        for($i=1; $i < $userCount; $i++) {
            for($x=0; $x < mt_rand(1,10); $x++) {
                $target = mt_rand(1, $userCount);
                if($target != $i) {
                    DB::table('followers')->insert([
                        'follower_id'   =>  $i,
                        'leader_id'     =>  $target
                    ]);
                }
            }



        }
    }
}
