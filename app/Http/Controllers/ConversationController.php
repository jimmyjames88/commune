<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = \App\User::find(Auth::id())->conversations;
        return view('conversations.index', compact('conversations'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conversation = \App\Conversation::find($id);

        // mark unread messages (not belonging to auth-user) as read
        $conversation->messages()->where([
                ['unread', 1],
                ['user_id', '!=', Auth::id()]
        ])->update(['unread' => 0]);

        $addableUsers = Auth::user()->followers->whereNotIn('conversation_user.user_id', $conversation->users()->pluck('user_id')->toArray());
        return view('conversations.show', compact('conversation', 'addableUsers'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invite(Request $request, $conversation_id)
    {
        $users = \App\User::whereIn('id', $request->invite)->get();
        //dd($users);
        $addedUsers = \App\Conversation::find($conversation_id)->users()->saveMany($users);
        if($addedUsers) {
            $request->session()->flash('message', 'Users have been added to the conversation');
            return back();
        }
        dd('Unspecified error');
    }
}
