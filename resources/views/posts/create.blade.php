@extends('layouts.app')

@section('title', 'Create content')

@section('content')
    @include('posts.partials.flashError')
    @include('posts.partials.flashStatus')
    
    <form action="{{ route('posts.store') }}" method="post">
        @include('posts.partials.form')
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
    
@endsection