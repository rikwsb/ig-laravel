<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::post('/post', [App\Http\Controllers\PostsController::class, 'store']);
Route::get('/post/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/home', [App\Http\Controllers\PostsController::class, 'index']);
Route::get('/post/{post}', [App\Http\Controllers\PostsController::class, 'show']);

//ESTA PRIMERA RUTA TAMBIEN ES DE LA API PERO ES MAS DE LA PARTE DE PERFILES
Route::get('/perfil/generatekey', [App\Http\Controllers\ProfilesController::class, 'generatekey']);

Route::get('/perfil/{user}/edit',[App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::get('/perfil/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::patch('/perfil/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);

//COSAS DE LA API PARA RUBENNNNN
Route::get('/api/posts', [App\Http\Controllers\ApiController::class, 'posts']);
Route::get('/api/users', [App\Http\Controllers\ApiController::class, 'users']);

Route::post('/api/user/create', [App\Http\Controllers\ApiController::class, 'createUser']);
Route::patch('/api/user/update', [App\Http\Controllers\ApiController::class, 'updateUser']);
Route::post('/api/post/create', [App\Http\Controllers\ApiController::class, 'createPost']);

Route::delete('/api/post/delete/{id}&api_token={api_token}', [App\Http\Controllers\ApiController::class, 'deletePost']);
Route::delete('/api/user/delete/{id}', [App\Http\Controllers\ApiController::class, 'deleteUser']);

Route::get('/api/user/{user}', [App\Http\Controllers\ApiController::class, 'user']);
Route::get('/api/post/{post}', [App\Http\Controllers\ApiController::class, 'post']);
