<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Conversation extends Model
{

    protected $fillable = ['unread_messages'];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

    public function getUnreadMessagesAttribute() {
        return $this->messages()->where([
            ['unread', 1],
            ['user_id', '!=', Auth::id()]
        ])->count();
    }

    public static function allUnreadMessages() {
        return \App\Message::whereHas('conversation', function($c) {
            $c->where([
                ['unread', 1],
                ['user_id', '!=', Auth::id()]
            ]);
        })->count();
    }
}
