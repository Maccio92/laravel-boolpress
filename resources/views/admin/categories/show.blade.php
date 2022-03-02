@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h1>
                    All posts of Category: {{ $category->name }}
                </h1>
            </div>
        </div>
        <div class="row">
                    @foreach ($category->posts()->get() as $post)
                        {{ $post->id }}
                            {{ $post->title }}
                            {{ $post->created_at }}
                            {{ $post->updated_at }}
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                        @endforeach
        </div>
    </div>
@endsection