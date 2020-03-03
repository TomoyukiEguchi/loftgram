<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    // Constructor: initial settings of newly created object instances from a class
    public function __construct() {
        
        // send to the login page if not login
        $this->middleware('auth');
    }
    
    public function index() {
        
        $posts = Post::limit(10)
            ->orderBy('created_at', 'desc')
            ->get();
            
         // show the template "post/index.blade.php"
        return view('post/index', ['posts' => $posts]);
    }
    
    public function new() {
        
         // show the template "post/new.blade.php"
        return view('post/new');
        
    }
    
    public function store(Request $request) {
        
        // validation
        $validator = Validator::make($request->all() , ['caption' => 'required|max:255', 'photo' => 'required']);

        // if validation errors
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Post 
        $post = new Post;
        $post->caption = $request->caption;
        $post->user_id = Auth::user()->id;
        
        //$post->image = base64_encode(file_get_contents($request->photo));
        
        // read 'photo'
        $image = $request->file('photo');
        // upload 'photo' to s3
        $path = Storage::disk('s3')->putFile('/post_images', $image, 'public');
        // get the pass
        $post->image = Storage::disk('s3')->url($path);
        $post->save();
        
        // redirect
        return redirect('/');
    }
    
    public function show($post_id) {
        $post = Post::where('id', $post_id)
            ->firstOrFail();
            
         // display a post page, "post/show.blade.php"
        return view('post/show', ['post' => $post]);
    }
    
    public function destroy($post_id) {
        
        $post = Post::find($post_id);
        $post->delete();
        return redirect('/');
    }
}
