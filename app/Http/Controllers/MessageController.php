<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Notification;
use App\Notifications\NewMessage;

class MessageController extends Controller
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
    public function store(Request $request, $conversation_id)
    {
        $request->validate([
            'body'  =>  'min:2|max:400'
        ]);

        $message = \App\Message::create([
            'body'              =>  $request->body,
            'user_id'           =>  Auth::id(),
            'conversation_id'   =>  $conversation_id
        ]);

        if($message) {
            // send notifications
            $conversation = $message->conversation;

            foreach($conversation->users as $user) {
                $user->notify(new NewMessage($message));
            }


            return redirect('/conversations/' . $conversation_id);
        }

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
}
