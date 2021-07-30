@extends('layouts.app')

@section('content')
<div class="container">
    <h5 class="mb-4">Todos los Usuarios</h5>
    <div class="d-flex mb-3">
    @foreach($users as $user)
        <div class="mr-5 text-center">
            <a href="/perfil/{{$user->id}}" class="text-dark"><img src="{{$user->profile->profileImage()}}" alt="User Profile Photo" class="rounded-circle" style="width: 5vh"></a>
            <a href="/perfil/{{$user->id}}" class="text-dark"><p>{{$user->username}}</p></a>
        </div>
    @endforeach
    </div>
    @foreach($posts as $post)
        <div class="row">
            <div class="col-sm-6 mb-3 offset-sm-3">
                <a href="/post/{{$post->id}}"><img src="/storage/{{$post->image}}" alt="Foto" class="w-100 mb-2"></a>
                <p><strong><a class="text-dark" href="/perfil/{{$post->user->id}}">{{$post->user->username}}: </a></strong>{{$post->descripcion}}</p>
            </div>
        </div>
    @endforeach
    @if($posts->count() == 0)
        <div class="text-center">
            <h4>Aún no sigues a nadie!</h4>
            <h5>Sigue a alguien para empezar a ver publicaciones.</h5>
        </div>
        @endif
</div>
@endsection
