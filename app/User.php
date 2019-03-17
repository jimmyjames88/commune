<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['followed_by_user'];


    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function profile() {
        return $this->hasOne('App\Profile');
    }

    public function followers() {
        return $this->belongsToMany('App\User', 'followers', 'leader_id', 'follower_id');
    }

    public function following() {
        return $this->belongsToMany('App\User', 'followers', 'follower_id', 'leader_id');
    }

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function likesArray()
    {
        return [];
    }

    public function getFollowedByUserAttribute()
    {
        return $this->followers()->where('follower_id', Auth::id())->count();
    }

    public function conversations() {
        return $this->belongsToMany('App\Conversation');
    }

    public function messages() {
        return $this->hasMany('App\Message');
    }

}
