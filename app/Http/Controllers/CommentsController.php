<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Auth;
use Validator;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct() {
        // construtor "send to login page if not login" -- "only for signed in users" 
        $this->middleware('auth');
    }
    
    // comment function
    public function store(Request $request) {
        // create an instance
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        // redirect to '/'
        return redirect()->back();
    }
    
    // comment "destroy" function
    public function destroy(Request $request) {
        
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        
        return redirect()->back();
    }
}
