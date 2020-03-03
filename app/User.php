<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //hasMany "Posts"
    public function posts() {
        return $this->hasMany('App\Post')->orderBy('created_at', 'DESC');
    }
    
    //hasMany "Likes"
    public function likes() {
        return $this->hasMany('App\Like');
    }
    
    //hasMany "Comments"
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    // following
    public function followings() {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    // follower
    public function followers() {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId) {
        
        // checking following ID and my ID
        
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
    
            // if already followed, do nothing
    
            return false;

        } else {
    
            // if not following yet, follow
    
            $this->followings()->attach($userId);
    
            return true;
    
        }
    }

    public function unfollow($userId) {
        
        // 
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            
            // if it's following, unfollow
            $this->followings()->detach($userId);
            
            return true;
            
        } else {
            // if not folloing, do nothing
            
            return false;
        }
    }
    
    public function is_following($userId) {
        
        return $this->followings()->where('follow_id', $userId)->exists();
    }
}
