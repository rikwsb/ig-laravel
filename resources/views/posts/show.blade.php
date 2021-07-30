@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            @if(preg_match("/http/i", $post->image) == 1)
                <img src="{{$post->image}}" class="w-100 mx-auto d-block">
            @else
                <img src="/storage/{{$post->image}}" class="w-100 mx-auto d-block">
            @endif
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
                <img src="{{$post->user->profile->profileImage() }}" alt="Foto de Perfil" class="rounded-circle mr-3" style="width: 7vh;">
                <div><strong><a class="text-dark" href="/perfil/{{$post->user->id}}">{{$post->user->username}}</a></strong></div>
            </div>
            <hr>
            <p><strong><a class="text-dark" href="/perfil/{{$post->user->id}}">{{$post->user->username}}: </a></strong>{{$post->descripcion}}</p>
        </div>
    </div>
</div>
@endsection
