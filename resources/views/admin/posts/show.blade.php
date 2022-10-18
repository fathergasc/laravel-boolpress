@extends('layouts.app')


@section('content')
<div class="container">
    <h3 class="mb-3">Title: {{$post->title}}</h3>
    @if ($post->cover_image)
        <img src="{{ asset('storage/' . $post->cover_image) }}" alt="" class="mb-3" style="height:400px">
    @else
        <img src="{{ asset('img/no_cover_default.jpg') }}" alt="" class="mb-3" style="height:400px">
        <p>No cover image</p>
    @endif

    <h3>Category: {{($post->category)?$post->category->name:'No category'}}</h3>
    <div>
        <h3 class="d-inline">Tags: </h3>
        @foreach ($post->tags as $tag)
            {{$tag->name}};
        @endforeach
    </div>
    <p>Content: {{$post->content}}</p>
    <h5>Slug: {{$post->slug}}</h5>


    <a class="btn btn-primary" href="{{route('admin.posts.index')}}">Back to posts list</a>
</div>

@endsection
