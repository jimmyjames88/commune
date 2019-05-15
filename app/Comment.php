<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'post_id', 'photo'];
    protected $appends = ['liked_by_user', 'belongs_to_user'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function post() {
        return $this->belongsTo('App\Comment');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    public function getLikedByUserAttribute() {
        $id = Auth::id();
        $like = $this->likes->first(function ($row) use ($id) {
            return $row->user_id === $id;
        });

        if($like) return true;
        return false;
    }

    public function getBelongsToUserAttribute() {
        return $this->user_id == Auth::id();
    }
}
