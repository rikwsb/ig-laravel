<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    /**
     * Devuelve todos los posts
     * @return Post[]|\Illuminate\Database\Eloquent\Collection
     */
    public function posts(){
        $posts = Post::all();
        return $posts;
    }

    /**
     * Nos permite recuperar la info del usuario que le pasemos como parametro en el link
     * @param Post $post Busca el usuario con el id que le hayamos pasado por parametro
     * @return Post
     */
    public function post(Post $post){
        return $post;
    }

    /**
     * Devuelve todos los usuarios
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function users(){
        $users = User::all();
        return $users;
    }

    /**
     * Nos permite recuperar la info del usuario que le pasemos como parametro en el link
     * @param User $user Busca el usuario con el id que le hayamos pasado por parametro
     * @return User
     */
    public function user(User $user){
        return $user;
    }

    /**
     * Nos permite crear un nuevo usuario
     * @param Request $data
     * @return User
     */
    public function createUser(Request $data){
        $user = new User([
           'name' => $data['name'],
           'email' => $data['email'],
           'username' => $data['username'],
           'password' => Hash::make($data['password'])
        ]);

        $user->save();

        return $user;
    }

    /**
     * Nos permite crear un nuevo post
     * @param Request $data
     * @return Post|\Illuminate\Http\JsonResponse
     */
    public function createPost(Request $data){

        $api_key = DB::table('users')
                    ->select('api_token')
                    ->where('api_token', '=', User::findOrFail($data['user_id'])->api_token)
                    ->get();

        $post = new Post([
           'user_id' => $data['user_id'],
           'descripcion' => $data['descripcion'],
           'image' => $data['image']
        ]);

        if($api_key[0]->api_token == $data['api_token']){
            $post->save();
        } else {
            return response()->json([
                'error' => 'Not authorised'
            ], 403);
        }

        return $post;
    }

    /**
     * Borra el post que le indiquemos
     * @param $id
     * @param $api_token
     * @return Post[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\JsonResponse
     */
    public function deletePost($id, $api_token){

        //dd($api_token);
        $post = Post::findOrFail($id);

        //User::findOrFail($data['user_id'])->api_token

        $api_tokens = $post->user->api_token;

//        $request = [
//            'user_id' => $data['user_id'],
//            'post_id' => $data['post_id'],
//            'api_token' => $data['api_token']
//        ];

        if($api_tokens == $api_token){
            $post->delete();
        } else {
            return response()->json([
                'error' => 'Not authorised'
            ], 403);
        }

        return Post::all();
    }

    /**
     * Borra el usuario que le indiquemos
     * @param $id
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function deleteUser($id){
        $user = User::findOrFail($id);
        $user->delete();
        return User::all();
    }

    public function updateUser(){

        $data = request()->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'user_id' => 'required',
            'api_token' => 'required'
        ]);

        $user = User::findOrFail($data['user_id']);

        if($user->api_token == $data['api_token']){
            $user->update([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email']
            ]);
        } else {
            return response()->json([
                'error' => 'Not authorised'
            ], 403);
        }

        return $user;
    }

}
