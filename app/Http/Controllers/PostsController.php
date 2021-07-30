<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function create(){
        return view('posts/create');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->get();
        $todosUsuarios = User::all();
        return view('posts.index',[
            'posts' => $posts,
            'users' => $todosUsuarios,
        ]);
    }

    public function store(){
        $data = request()->validate([
            'descripcion' => 'required',
            'image' => 'required|image',
        ]);

        $rutaArchivo = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$rutaArchivo}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'descripcion' => $data['descripcion'],
            'image' => $data['descripcion'],
        ]);

        return redirect('/perfil/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post){
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
