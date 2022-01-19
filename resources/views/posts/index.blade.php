@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    @include('posts.partials.flashError')
    @include('posts.partials.flashStatus')
    <form action="{{ route('posts.create') }}" class="mb-3" method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
    @if(count($posts))
        @foreach($posts as $post)

            <h1 class="mt-2"><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post['title'] }}</a></h1>
            <div class="form-inline">
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary mr-1">Edit</a>
                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endforeach()
    @else
        <h2>No posts found</h2>
    @endif

@endsection