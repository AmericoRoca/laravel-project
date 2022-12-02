<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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


       //Run query and changes in the database
       $user->update();

       return redirect()->route('config')
                        ->with(['message'=>'User updated successfully']);

        

    }
}
