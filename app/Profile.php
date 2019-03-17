<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['bio', 'user_id', 'location', 'website', 'avatar', 'birthday'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
