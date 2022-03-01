@extends ('layouts.admin')

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
                <div class="d-flex">
                    <button class="btn btn-primary mx-2"><a class="text-light" href="{{ route('admin.posts.show', $post->id) }}">Vai</a></button>
                    <button class="btn btn-primary mx-2"><a class="text-light" href="{{ route('admin.posts.edit', $post) }}">Modifica</a></button>
                    <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger mx-2" type="submit" value="Delete">
                                </form>
                </div>
            </div>
        @endforeach
    {{ $posts->links()}}
    </div>    
    
</div>

@endsection