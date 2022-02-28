<!-- @dd($posts) -->
@extends ('layouts.app')

@section('content')
<h2 class="p-2 bg-secondary">Posts:</h2>
<div class="container">
    <div class="row">
        @foreach($posts as $post)
    <div class="d-flex my-3 align-items-center justify-content-between border-bottom border-1">
        <div class="my-1">
            <h3 class="m-0 text-capitalize">{{$post -> title}}</h3>
        </div>
        <div class="d-flex gap-5">
            <button class="btn btn-primary"><a class="text-light" href="{{ route('admin.posts.create', $post) }}">Vai</a></button>
        </div>
    </div>
    @endforeach
    {{ $posts->links()}}
    </div>    
    
</div>

@endsection