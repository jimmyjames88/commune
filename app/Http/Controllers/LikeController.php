<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    public function handleLike($id, $type)
    {
        // assign type string to be used in DB column
        if($type == 'post') {
            $type = 'App\Post';
        } else {
            $type = 'App\Comment';
        }

        // check for existing identical Like
        $exists = \App\Like::where([
            ['likeable_id', '=', $id],
            ['likeable_type', '=', $type],
            ['user_id', '=', Auth::id()]
        ])->first();

        if($exists){
            // if it exists, "unlike" it by deleting it
            $exists->delete();
        } else {
            // otherwise create a new like
            $like = \App\Like::create([
                'likeable_id'   =>  $id,
                'likeable_type' =>  $type,
                'user_id'       =>  Auth::id()
            ]);

        }
        return response()->json([
            'status'    =>  'success',
        ]);
    }
}
