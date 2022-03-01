@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <div class="row bg-dark p-3">
            <div class="col">
                <h1 class="text-light text-capitalize">{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row border-bottom border-2 p-3">
            <div class="col-12">
                <h2 class="text-dark text-capitalize">autore: {{ $post->author }}</h2>
            </div>
        </div>
        <div class="row border-bottom border-2 p-3 bg-info">
            <div class="col">
                <p class="text-dark">Descrizione:<br>{{ $post->content }}</p>
            </div>
        </div>
        <div class="p-3">
            <button class="btn btn-primary"><a class="text-light text-capitalize p-2" href="{{ route('admin.posts.index') }}">Back</a></button>
        </div>
    </div>
@endsection