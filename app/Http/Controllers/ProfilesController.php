<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows,
        ]);
    }

    public function edit(User $user){
        $this->authorize('update',$user->profile);
        return view('profiles.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user){
        $this->authorize('update',$user->profile);
        $data = request()->validate([
            'titulo' => 'required',
            'descripcion' => '',
            'url' => '',
            'image' => '',
        ]);

        if(request('image')){
            $rutaArchivo = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$rutaArchivo}"))->fit(800,800);
            $image->save();
            $imageArray = ['image' => $rutaArchivo];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/perfil/{$user->id}");
    }

    public function generatekey(){
        $user = User::find(auth()->user()->getAuthIdentifier());
        $user->api_token = bin2hex(random_bytes(10));
        $user->save();
        return redirect("/perfil/{$user->id}");
    }
}
