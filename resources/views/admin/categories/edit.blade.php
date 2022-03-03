@extends ('layouts.admin')

@section('content')
<div class="container">
        <div class="row">
            <form action="{{ route('admin.categories.update', $category) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Categoria</label>
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