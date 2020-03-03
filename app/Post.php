<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // belongsTo "User"
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    // hasMany "Like"
    public function likes() {
        return $this->hasMany('App\Like');
    }
    
    // looking for likes by 'user_id'
    public function likedBy($user) {
        return Like::where('user_id', $user->id)->where('post_id', $this->id);
    }
    
    // hasMany "Comment"
    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
