<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get a simple array of ID's of users I follow
        $following = DB::table('followers')
                        ->where('follower_id', Auth::id())
                        ->pluck('leader_id')
                        ->toArray();

        // load posts of Users I follow
        $posts = \App\Post::with(['user', 'comments', 'likes'])
                    ->whereIn('user_id', $following)
                    ->paginate(20);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new \App\Post;
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* if validations fails, the user will be
           sent back automatically (with errors) */
        $data = $request->validate([
            'body'  =>  'required|min:2|max:280',
        ]);

        // set user_id (author) to authenticated user
        $data['user_id'] = Auth::id();
        $post = \App\Post::create($data);


        // if successful, redirect to the post
        if($post) {
            return redirect('/posts/' . $post->id);
        } else {
            return back()->withErrors([
                'message' => 'Unspecified error: post not created'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = \App\Post::with(['comments', 'comments.user', 'comments.likes', 'likes'])->find($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // load post
        $post = \App\Post::find($id);

        // change post body
        $post->body = $request->input('body');

        // save
        $post->save();
    }

    public function delete($id)
    {
        return view('widgets.confirm_delete', [
            'type'  =>  'Post',
            'action'    =>  '/posts/' . $id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // do delete
        $delete = \App\Post::destroy($id);

        // check if delete successful
        if($delete) {
            return redirect('/posts');
        } else {
            dd('Unspecified error');
        }
    }

}
