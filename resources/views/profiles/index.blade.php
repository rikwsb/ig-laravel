@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            <img src="{{$user->profile->profileImage()}}" alt="Foto de Perfil" class="rounded-circle w-100">
        </div>
        <div class="col-9">
            <div class="d-flex align-items-center">
                <h1 class="m-0 p-0 mr-3">{{ $user->username }}</h1>
                @if(Auth()->user()->id != $user->id)
                <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                @endif
            </div>
            @if(Auth()->user()->id == $user->id && Auth()->user()->api_token != null)
                <div><strong>Api key: </strong>{{ $user->api_token }}</div>
            @endif
            <div class="d-flex">
                <div class="pr-3"><strong>{{$user->posts->count()}}</strong> Publicaciones</div>
                <div class="pr-3"><strong>{{$user->profile->followers->count()}}</strong> Seguidores</div>
                <div class="pr-3"><strong>{{$user->following->count()}}</strong> Seguiendo</div>
            </div>
            <div class="pt-2"><strong>{{ $user->profile->titulo}}</strong></div>
            <div>{{ $user->profile->descripcion }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
            <div>
                @can('update',$user->profile)
                    <a href="/perfil/{{$user->id}}/edit"><button type="button" class="btn btn-outline-primary mr-3 mt-2">Editar Perfil</button></a>
                @endcan
                @can('update',$user->profile)
                    <a href="/post/create"><button type="button" class="btn btn-primary mt-2 mr-3">Crear Post</button></a>
                    @endcan
                    @can('update',$user->profile)
                        <a href="/perfil/generatekey"><button type="button" class="btn btn-primary mt-2">Generar Api Key</button></a>
                    @endcan

            </div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
            <div class="col-4 pb-3">
                <a href="/post/{{$post->id}}"><img src="/storage/{{$post->image}}" class="w-100"></a>
            </div>
        @endforeach
    </div>
</div>
@endsection
