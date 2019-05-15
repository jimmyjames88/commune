<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = ['body', 'conversation_id', 'user_id'];

    public function conversation() {
        return $this->belongsTo('App\Conversation');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
