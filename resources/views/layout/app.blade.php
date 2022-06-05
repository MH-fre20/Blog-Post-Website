<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="{{ asset('rcs/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/b3c415d1c4.js" crossorigin="anonymous"></script>
    <title> Laravel App - @yield('title')</title>
</head>
<style>
    #header {
        box-shadow: 2px 2px 2px lightblue;
    }

    #mynav {
        display: flex;
        flex-wrap: wrap;
        gap: 0.3rem;
        position: relative;
        left: .8rem;
    }

</style>

<body>
    <div id="header" class="d-flex justify-content-around align-items-center p-3 px-md-4 bg-white">
        <h5 class="my-0 mr-md-auto font-weight-normal">laravel App</h5>
        <nav class="my-2 my-md-0 mr-md-3" id="mynav">
            <a class="p-2 text-dark" href="{{ route('nothome.index') }}">Home</a>
            <a class="p-2 text-dark" href="{{ route('nothome.contact') }}">Contact</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">Blog Posts</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">Add</a>
            @guest
                @if (Route::has('register'))
                    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                @endif
                <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
            @else
                <a class="p-2 text-dark" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.querySelector('#logout-form').submit();">Logout
                    ({{ Auth::user()->name }})</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
                @endguest
                <ul class="hambargar">
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </nav>
        </div>
        <div class="slideshow">
            <i class="fa-solid fa-xmark fa-3x" id="close"></i>
            <a href="{{ route('nothome.index') }}">Home</a>
            <a href="{{ route('nothome.contact') }}">Contact</a>
            <a href="{{ route('posts.index') }}">Blog Posts</a>
            <a href="{{ route('posts.create') }}">Add</a>
            @guest
                @if (Route::has('register'))
                    <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                @endif
                <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
            @else
                <a class="p-2 text-dark" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.querySelector('#logout-form').submit();" id="unique">Logout
                    ({{ Auth::user()->name }})</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf</form>
                    @endguest
            </div>
            <div class="overlay"></div>
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success">
                    <li>{{ session('status') }}</li>
                </div>
            @endif
            @yield('content')
        </div>
        <script src="script.js"></script>
    </body>

    </html>
