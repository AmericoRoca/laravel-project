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
    // Asegura que solo usuarios autenticados puedan acceder a este controlador
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Muestra el formulario para crear una nueva imagen
    public function create()
    {
        return view('image.create');
    }

    // Guarda la imagen en la base de datos y almacena el archivo en el sistema
    public function save(Request $request)
    {
        // Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        // Recoge los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Asigna valores al objeto de la imagen
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        // Subir archivo si existe
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        
        $image->save();

        return redirect()->route('home')->with([
            'message' => 'The image was successfully uploaded'
        ]);
    }

    // Recupera una imagen almacenada en el sistema
    public function getImage($filename)
    {
        if (Storage::disk('images')->exists($filename)) {
            $file = Storage::disk('images')->get($filename);
            return new Response($file, 200);
        }
        return abort(404, 'Image not found');
    }

    // Muestra los detalles de una imagen específica
    public function detail($id)
    {
        $image = Image::find($id);

        // Verifica si la imagen existe
        if (!$image) {
            return redirect()->route('home')->with('error', 'Image not found');
        }

        return view('image.detail', [
            'image' => $image
        ]);
    }

    // Elimina una imagen y todos sus comentarios y likes asociados
    public function delete($id)
    {
        $user = \Auth::user();
        $image = Image::find($id);

        // Verifica si la imagen existe y si el usuario tiene permiso para eliminarla
        if ($user && $image && $image->user_id == $user->id) {
            // Elimina los comentarios
            $comments = Comment::where('image_id', $id)->get();
            if ($comments) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }

            // Elimina los likes
            $likes = Like::where('image_id', $id)->get();
            if ($likes) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }

            // Elimina el archivo de imagen
            Storage::disk('images')->delete($image->image_path);

            // Elimina la entrada de la imagen en la base de datos
            $image->delete();

            $message = ['message' => 'The picture was deleted successfully'];
        } else {
            $message = ['message' => 'The picture could not be deleted'];
        }

        return redirect()->route('home')->with($message);
    }
}
