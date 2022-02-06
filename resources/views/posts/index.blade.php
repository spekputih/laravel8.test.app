@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    @include('posts.partials.flashError')
    @include('posts.partials.flashStatus')
    <form action="{{ route('posts.create') }}" class="mb-3" method="get">
        @csrf
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
    @if (count($posts))
    <div class="row">
        <div class="col-8">

        
        @foreach ($posts as $post)
            <div class="card mb-2">
                <div class="card-body">
                    <h1 class="mt-2"><a
                            href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post['title'] }}</a></h1>
                    <p class="text-muted m-0">
                        Added {{ $post->created_at->diffForHumans() }}

                        by {{ $post->user->name }}
                    </p>
                    @if ($post->comment_count)
                        <p>{{ $post->comment_count }} comments</p>
                    @else
                        <p>No comment yet</p>
                    @endif
                    <div class="form-inline">

                        @can('update', $post)
                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary mr-1">Edit</a>
                        @endcan

                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        
        @endforeach()
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Most Commented Blog Post</h4>
                <hr>
               
                @foreach ($mostCommented as $post)
                    <h5 class="card-title"><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h5>
                    
                @endforeach
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
    </div>
    @else
        <h2>No posts found</h2>
    @endif

@endsection
