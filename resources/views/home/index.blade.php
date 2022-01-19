@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
 <h1>Hello world</h1>
    <form action="/send" method="post">
        @csrf
        
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="content">Content:</label><br>
        <input type="text" id="content" name="content">
        <button type="submit" class="btn btn-dark">Submit</button>
        
    </form>
@endsection