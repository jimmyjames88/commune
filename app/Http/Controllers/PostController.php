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
        array_push($following, Auth::id());

        // load posts of Users I follow
        $posts = \App\Post::with(['user', 'user.profile', 'comments', 'likes'])
                    ->whereIn('user_id', $following)
                    ->latest()
                    ->paginate(10);

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
        $request->validate([
            'body'  =>  'required|min:2|max:280',
            'photo' =>  'image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        // setup new post
        $post = new \App\Post;
        $post->user_id = Auth::id();
        $post->body = $request->body;

        if($request->photo){
            // photo prep for upload
            $image = $request->file('photo');
            $new_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $post->photo = $new_name;
        } else {
            $post->photo = null;
        }

        // save, if successful redirect to the post
        if($post->save()) {

            // upload photo
            if($post->photo) $image->move(public_path("images/posts/" . $post->id), $new_name);

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

        return view('posts.show', [
            'post'  =>  $post,
            'hideCommentPreview' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = \App\Post::find($id);
        return view('posts.edit', compact('post'));
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

        print_r($request->photo);

        if($request->photo){
            // photo prep for upload
            $image = $request->file('photo');
            $new_name = uniqid() . '.' . $image->getClientOriginalExtension();
            $post->photo = $new_name;
        }



        // save
        if($post->save()) {

            // upload photo
            if($request->photo) $image->move(public_path("images/posts/" . $post->id), $new_name);
            return redirect('/posts/' . $post->id);
        }
        dd('unspecified error');
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

    public function like($id)
    {

        $like = new \App\Like;
        $like->user_id = Auth::id();
        $like->post_id = $id;

        if($like->save()) {
            return json_encode([
                'status' => 'success'
            ]);
        }

        return json_encode([
            'status' => 'failed'
        ]);

    }


    public function unlike($id)
    {
        $like = \App\Like::where('post_id', $id)
                            ->where('user_id', Auth::id())
                            ->first();

        if($like->delete()) {
            return json_encode([ 'status' => 'success' ]);
        }

        return json_encode([ 'status' => 'failed' ]);
    }

}
