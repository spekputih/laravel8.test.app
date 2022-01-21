<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App-@yield('title')</title>
    <link rel="stylesheet" href='{{ mix('css/app.css') }}' >
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm mb-3">
        <h5 class="my-0 mr-md-auto p-2 font-weight-normal">Laravel App</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a href="{{ route('home.index') }}" class="p-2 text-dark">Home</a>
            <a href="{{ route('home.contact') }}" class="p-2 text-dark">Contact</a>
            <a href="{{ route('posts.index') }}" class="p-2 text-dark">Blog Posts</a>
            <a href="{{ route('posts.create') }}" class="p-2 text-dark">Add Blog Post</a>
            @guest
                <a href="{{ route('register') }}" class="p-2 text-dark">Register</a>
                <a href="{{ route('login') }}" class="p-2 text-dark">Login</a>
            @else
                <a href="{{ route('logout') }}" class="p-2 text-dark" 
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                >Logout</a>
                <form id='logout-form' action="{{ route('logout') }}" method="post" style="display: none">
                    @csrf
                </form>
            @endguest
        </nav>
    </div>
    <div class="container">
        @yield('content')
    </div>
    
</body>
</html>