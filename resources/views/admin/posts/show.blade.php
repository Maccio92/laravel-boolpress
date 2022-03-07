@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
        <div class="row p-3">
            <ul class="list-unstyled col">
                <li class="bg-dark p-2">
                    <h1 class="text-light text-capitalize m-0">{{ $post->title }}</h1>
                </li>
                <li class="bg-light">
                    <h2 class="bg-primary text-light p-2 text-capitalize">autore: </h2>
                    <h4 class="text-dark">{{ $post->user()->first()->name }}</h4>
                </li>
                <li>  
                    <h4 class="bg-primary text-light p-2">Descrizione</h4>
                    <p class="text-dark">{{ $post->content }}</p>
                </li>
                <li>  
                    <img class="img-fluid" src="{{ asset('storage/' . $post->image)}}" alt="{{ $post->image }}">
                </li>
                <li>
                <h4 class="bg-primary text-light p-2">Tags:</h4>
                @foreach ($post->tags()->get() as $tag)
                    <a href="#" class="text-dark text-capitalize">{{ $tag->name }}</a>
                @endforeach
                </li>
            </ul>
        <div class="py-3">
            </div>
        </div>
        <button class="btn btn-primary"><a class="text-light text-capitalize p-2" href="{{ route('admin.posts.index') }}">Back</a></button>
@endsection