<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $comment = \App\Comment::create([
            'body'      =>  $request->body,
            'user_id'   =>  Auth::id(),
            'post_id'   =>  $id
        ]);

        if($comment) {
            $request->session()->flash('message', 'Your comment has been added');
            return redirect( url()->previous() . '#c' . $comment->id);
        }

        $request->session()->flash('error', 'Error adding comment');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id, $comment_id)
    {
        $comment = \App\Comment::find($comment_id);
        $post = $comment->post;
        return view('comments.edit', compact('comment', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id, $comment_id)
    {
        $request->validate([
            'body'  =>  'min:2|max:400'
        ]);

        $comment = \App\Comment::find($comment_id);
        $comment->body = $request->body;

        if($comment->save()) {
            return redirect('/posts/' . $post_id);
        }

        dd('Unspecified error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $comment_id)
    {
        $delete = \App\Comment::destroy($comment_id);
        if($delete) {
            return redirect('/posts/' . $post_id);
        }
        dd('Unspecified error');
    }


    public function delete($post_id, $comment_id)
    {
        return view('widgets.confirm_delete', [
            'type'  =>  'Comment',
            'action'    =>  '/posts/' . $post_id . '/comments/' . $comment_id,
        ]);
    }

}
