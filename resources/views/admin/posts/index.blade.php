@extends ('layouts.admin')

@section('content')
<div class="d-flex align-items-center justify-content-between bg-primary bg-gradient p-2">
    <h2 class="text-light m-0">Posts:</h2>
    <a class="btn btn-outline-light" href="{{ route('admin.posts.create') }}">Add Post</a>
</div>

<div class="container">
    <div class="row">
        <ul class="col my-3 list-unstyled">
            @foreach($posts as $post)
                <li class="d-flex align-items-center justify-content-between py-3 border-bottom">
                    <h3 class="m-0 text-capitalize">{{$post -> title}}</h3>
                    <div class="d-flex">
                        <button class="btn btn-success mx-2"><a class="text-light" href="{{ route('admin.posts.show', $post->slug) }}">Vai</a></button>
                        @if (Auth::user()->id === $post->user_id)
                        <button class="btn btn-warning mx-2">
                            <a class="text-dark" href="{{ route('admin.posts.edit', $post->slug) }}">Modifica</a>
                        @endif</button>
                        @if (Auth::user()->id === $post->user_id)
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger mx-2" type="submit" value="Delete">
                            </form>
                        @endif
                    </div>
                </li>
                @endforeach
            </ul>   
    </div>    
    <div class="row">
                {{ $posts->links()}}
            </div>
</div>

@endsection