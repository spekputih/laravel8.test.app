@extends('layouts.app')

@section('title', 'Update content')

@section('content')
    @include('posts.partials.flashError')
    @include('posts.partials.flashStatus')
    
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post">
        @method('PUT')
        @include('posts.partials.form')
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    
@endsection