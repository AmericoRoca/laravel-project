<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Comment;
use App\Models\Like;

class ImageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){
        //validation
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        //Pick up the data
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //Asign values to the object
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        //upload file
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        
        $image->save();

        return redirect()->route('home')->with([
            'message' => 'The image is succesfully uploaded'
        ]);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image/detail', [
            'image' => $image
        ]);
    }

    public function delete($id){
        $user = \Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if($user && $image && $image->user->id == $user->id){
            //delete comments
            if($comments && count($comments)>=1){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            //delete likes
            if($likes && count($likes)>=1){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            //delete files
            Storage::disk('images')->delete($image->image_path);

            //delete image
            $image->delete();

            $message = array('message' => 'The picture delete susccessfully');

        } else {
            $message = array('message' => 'The picture doesn´t delete correctly');
        }
        return redirect()->route('home')->with($message);

    
    }

    
}
