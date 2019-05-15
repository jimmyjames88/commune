<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<$GLOBALS['userCount']; $i++) {
            DB::table('followers')->insert([
                'follower_id'   =>  mt_rand(1, $GLOBALS['userCount']),
                'leader_id'     =>  mt_rand(1, $GLOBALS['userCount'])
            ]);
        }
    }
}
