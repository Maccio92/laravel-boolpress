@extends('layouts.admin')

@section('content')
<div class="container">
<a class="btn btn-primary" href="{{ route('admin.categories.create') }}">Add Category</a>
    <div class="row flex-column">
        @foreach($categories as $category)
            <div class="d-flex my-3 align-items-center justify-content-between border-bottom border-1">
                <div class="my-1">
                    <h3 class="m-0 text-capitalize">{{$category -> name}}</h3>
                    <button class="btn btn-primary mx-2"><a class="text-light" href="{{ route('admin.categories.show', $category->slug) }}">View</a></button>
                    <button class="btn btn-primary mx-2"><a class="text-light" href="{{ route('admin.categories.edit', $category->slug) }}">Modifica</a></button>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger mx-2" type="submit" value="Delete">
                        </form>
                </div>
            </div>
        @endforeach
    </div>    
    
</div>
@endsection

