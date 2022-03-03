@extends ('layouts.admin')

@section('content')
<div class="container">
        <div class="row">
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="form-label">Nome categoria</label>
                    <input type="text" class="form-control" id="name" name="name">
                    @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection