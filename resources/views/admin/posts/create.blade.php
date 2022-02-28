@extends ('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <form action="{{ route('admin.posts.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title">
                    @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Autore</label>
                    <input type="text" class="form-control" id="author" name="author">
                    @error('author')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                    @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection