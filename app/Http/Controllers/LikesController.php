<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Auth;
use Validator;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    // Constructor: initial settings of newly created object instances from a class
    public function __construct()
    {
        // if not login, send to the login page
        $this->middleware('auth');
    }
    
    // 'Like' function
    public function store(Request $request) {
        // 
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;
        $like->save();

        // 「/」 re-direct
        return redirect()->back();
    }
    
    // destroy "Like" function
    public function destroy(Request $request) {
        
        $like = Like::find($request->like_id);
        $like->delete();
        return redirect()->back();
    }
}
