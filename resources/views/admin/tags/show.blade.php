@extends('layouts.app')


@section('content')
<div class="container">
    <h3>Name: {{$tag->name}}</h3>
    <h3>Slug: {{$tag->slug}}</h3>


    <h4>Related posts:</h4>
    @if (count($tag->posts()->withTrashed()->get())) <!--called posts as a method and not as an attribute because of withTrashed(), without it it'd be "(count($tags->posts)" -->
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tag->posts()->withTrashed()->get() as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td><a class="btn btn-warning m-1" href="{{route('admin.posts.show', ['post' => $post->id])}}">Go to post</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <a class="btn btn-primary" href="{{route('admin.tags.index')}}">Back to tags list</a>
</div>

@endsection
