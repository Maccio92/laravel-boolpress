@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row flex-column">
        @foreach($categories as $category)
            <div class="d-flex my-3 align-items-center justify-content-between border-bottom border-1">
                <div class="my-1">
                    <h3 class="m-0 text-capitalize">{{$category -> name}}</h3>
                    <button class="btn btn-primary mx-2"><a class="text-light" href="{{ route('admin.categories.show', $category->slug) }}">View</a></button>
                </div>
            </div>
        @endforeach
    </div>    
    
</div>
@endsection

