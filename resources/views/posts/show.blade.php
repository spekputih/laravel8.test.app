@extends('layouts.app')

@section('title', $post['title'])

@section('content')
 <h1>{{ $post->title }}</h1>
 <h4>{{ $post->content }}</h4>
 <p>Added {{ $post->created_at->diffForHumans() }}</p>
 @if (now()->diffInMinutes($post->created_at) <5)
    <span class="badge badge-success">New</span>
 @endif
@endsection