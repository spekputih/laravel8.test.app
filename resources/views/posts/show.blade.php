@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    <h1>{{ $post->title }}</h1>
    <h4>{{ $post->content }}</h4>
    <p>
        @updated(['date' => $post->created_at])
        @endupdated
    </p>
    <p>
        @updated(['date' => $post->updated_at])
            Updated
        @endupdated
    </p>


    @badge(['show' => now()->diffInMinutes($post->created_at) < 5]) Brand new post @endbadge <h3>Comments</h3>
        @forelse ($post->comment as $comment)
            <div class="card mb-1">
                <div class="card-body">
                    <h5>{{ $comment->content }}</h5>
                    <p class="text-muted m-0">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            <p>No comment yet</p>
        @endforelse
    @endsection
