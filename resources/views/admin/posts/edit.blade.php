@extends ('layouts.admin')

@section('content')
<div class="container">
        <div class="row">
            <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data" class="col">
                @csrf
                @method('PATCH')
                <div>
                    <legend class="bg-primary text-light p-2">Titolo</legend>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                    @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 py-3">
                <legend class="bg-primary text-light p-2">Contenuto</legend>
                    <textarea class="form-control" id="content" name="content" rows="3">{{ $post->content }}</textarea>
                    @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 py-3">
                    <select class="form-select" name="category_id">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option @if (old('category_id', $post->category_id) == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }} - {{ $category->id }}</option>
                            @endforeach
                    </select>
                </div>
                @error('tags.*')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-3 py-3">
                <legend class="bg-primary text-light p-2">Tags</legend>
                    @if ($errors->any())
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                    {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        @foreach ($tags as $tag)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="tags[]"
                                    {{ $post->tags()->get()->contains($tag->id)? 'checked': '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if (!empty($post->image))
                <div class="mb-3 py-3">
                    <img src="{{ asset('storage/' . $post->image)}}" alt="{{ $post->image }}">  
                </div>
                @endif
                <div class="mb-3 py-3">
                    <legend class="bg-primary text-light p-2">Sostituisci l'immagine</legend>
                    <label class="form-label" for="image"></label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                @error('image')
                        <div class="alert alert-danger mt-3">
                            {{ $message }}
                        </div>
                @enderror
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection