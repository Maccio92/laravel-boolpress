@extends ('layouts.admin')

@section('content')
<div class="container">
        <div class="row">
            <form action="{{ route('admin.categories.update', $category) }}" method="post" class="col">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                <legend class="bg-primary text-light p-2">Nome Categoria</legend>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                    @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection