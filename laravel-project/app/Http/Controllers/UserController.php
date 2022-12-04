<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function config(){
        return view('user.config');
    }
    
    public function update(Request $request){

        

        //Get user Authenticated
        $user = \Auth::user();
        $id = \Auth::user()->id;

        //Form validation
        $validate = $this->validate($request, [
    		'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
    	]);

        //Pick up form data
       $name = $request->input('name');
        $surname = $request->input('surname');
       $nick = $request->input('nick');
       $email= $request->input('email');

       //give it new values to user object
       $user->name = $name;
       $user->surname = $surname;
       $user->nick = $nick;
       $user->email = $email;

       //images upload
       $image_path = $request->file('image_path');

       if($image_path){

        //Set up a  unique name
        $image_path_full = time().$image_path->getClientOriginalName();

        //Safe on the users folder
        Storage::disk('users')->put($image_path_full, File::get($image_path));

        //Set the image name on the object
        $user->image = $image_path_full;
       }


       

       //Run query and changes in the database
       $user->update();

       return redirect()->route('config')
                        ->with(['message'=>'User updated successfully']);

        

    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
