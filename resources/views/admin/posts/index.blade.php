@extends ('layouts.app')

@section('content')
<div class="d-flex align-items-center justify-content-around bg-secondary">
    <h2 class="p-2 ">Posts:</h2>
    <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Add Post</a>
</div>

<div class="container">
    <div class="row flex-column">
        @foreach($posts as $post)
            <div class="d-flex my-3 align-items-center justify-content-between border-bottom border-1">
                <div class="my-1">
                    <h3 class="m-0 text-capitalize">{{$post -> title}}</h3>
                </div>
                <div class="d-flex gap-5">
                    <button class="btn btn-primary"><a class="text-light" href="{{ route('admin.posts.show', $post) }}">Vai</a></button>
                </div>
            </div>
        @endforeach
    {{ $posts->links()}}
    </div>    
    
</div>

@endsection