<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        //Validation
        $validate = $this->validate($request, [
            'image_id'=>'integer|required',
            'content' => 'string|required'
        ]);

        //Pick up data
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //Asign values to the new Object
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        //Save on the database
        $comment->save();


        //Redirect
        return redirect()->route('image.detail', ['id' => $image_id])
                        ->with([
                            'message' => 'Comment published successfully'
                        ]);

    }
}
