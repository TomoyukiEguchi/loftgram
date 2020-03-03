<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    //
    // Constructor: initial settings of newly created object instances from a class
    public function __construct() {
        
        // if not login, send to the login page
        $this->middleware('auth');
    }
    
    public function show($user_id) {
        
        $user = User::where('id', $user_id)
            ->firstOrFail();
            
        // show the template "user/show.blade.php"
        return view('user/show', ['user' => $user]);
    }
    
    public function edit() {
        
        $user = Auth::user();
            
        // show the edit template "user/edit.blade.php"
        return view('user/edit', ['user' => $user]);
    }
    
    public function update(Request $request) {
        
        // validation: check values
        $validator = Validator::make($request->all() , [
            'user_name' => 'required|string|max:255',
            'user_password' => 'required|string|min:6|confirmed',
            ]);

        // if validation errors
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $user = User::find($request->id);
        $user->name = $request->user_name;
        if ($request->user_profile_photo !=null) {
            // read 'user_profile_photo'
            $image = $request->file('user_profile_photo');
            // upload 'user_profile_photo' to s3
            $path = Storage::disk('s3')->putFile('/user_images', $image, 'public');
            // get the pass
            $user->profile_photo = Storage::disk('s3')->url($path);
            
            //$request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            //$user->profile_photo = $user->id . '.jpg';
        }
        $user->password = bcrypt($request->user_password);
        $user->save();

        return redirect('/users/'.$request->id);
    }
    
    public function followings($id) {
        
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followings,
        ];
        
        //$data += $this->counts($user);
        
        return view('user/followings', $data);
    }
    
    public function followers($id) {
        
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);
        
        $data = [
            'user' => $user,
            'users' => $followers,
        ];
        
        //$data += $this->counts($user);
        
        return view('user/followers', $data);
    }
}
