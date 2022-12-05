<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id){
        //Pick up user data adn image
        $user = \Auth::user();

        //if exist like and don't duplicate it
        
        $isset_like = Like::where('user_id',$user->id )
                ->where('image_id', $image_id)
                ->count();


        if($isset_like == 0){

            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
    
            //Save on database
            $like->save();

            return response()->json([
                'like' => $like
            ]);
    
        } else {

            return response()->json([
                'message' => 'Like already exists'
            ]);
        }
       
    
    }

    public function dislike($image_id){
             //Pick up user data adn image
             $user = \Auth::user();

             //if exist like and don't duplicate it
             
             $like = Like::where('user_id',$user->id )
                     ->where('image_id', $image_id)
                     ->first();
     
             
             if($like){
     
                 $like->delete();

                 return response()->json([
                    'like' => $like,
                    'message' => 'Dislike correct'
                ]);


         
             } else {
                 
                 return response()->json([
                    'message' => 'Like doesn´t exists'
                 ]);
             }
    }
}
