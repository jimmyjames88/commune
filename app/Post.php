<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
    protected $fillable = ['user_id', 'body'];
    protected $appends = ['liked_by_user', 'belongs_to_user'];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

    // set a property to see if the post is liked by a user
    public function getLikedByUserAttribute()
    {
        $id = Auth::id();
        $like = $this->likes->first(function ($row) use ($id) {
            return $row->user_id === $id;
        });

        if($like) return true;
        return false;
    }

    public function getBelongsToUserAttribute()
    {
        return $this->user_id === Auth::id();
    }
}
