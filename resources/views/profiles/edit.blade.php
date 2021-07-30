@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar tu Perfil</div>

                <div class="card-body">
                    <form method="POST" action="/perfil/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="titulo" class="col-md-4 col-form-label text-md-right">Titulo</label>

                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control  @error('titulo') is-invalid @enderror" name="titulo" value="{{ old('titulo') ?? $user->profile->titulo}}" autocomplete="titulo">

                                @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripción</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control  @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') ?? $user->profile->descripcion}}" autocomplete="descripcion">

                                @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label text-md-right">URL</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control  @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url}}" autocomplete="url">

                                @error('url')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Foto de Perfil</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image">

                                @error('image')
                                <strong class="invalid-feedback">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar Perfil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
