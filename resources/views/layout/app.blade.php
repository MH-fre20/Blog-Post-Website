<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/stylization/style.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/b3c415d1c4.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <title> Laravel App - @yield('title')</title>
</head>
<style>
    #header {
        box-shadow: 0px 2px 2px lightblue;
        transition: transform .3s;
    }

    #mynav {
        display: flex;
        flex-wrap: wrap;
        gap: 0.3rem;
        position: relative;
        left: .8rem;
    }

    #LaravelApp::after {
        content: '';
        width: 0%;
        background-color: black;
        transition: width .3s;
    }

    #LaravelApp:hover::after {
        width: 100%
    }
</style>

<body id="my-scrollbar">
    <div id="header" class="d-flex justify-content-around align-items-center p-3 px-md-4 bg-white fixed-top">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{ route('posts.index') }}"
                class="text-decoration-none fs-3 text-dark" id="LaravelApp">Laravel App</a></h5>
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
        <i class="fa-solid fa-xmark fa-3x" class="close"></i>
        <a href="{{ route('nothome.index') }}" id="size">Home</a>
        <a href="{{ route('nothome.contact') }}" id="size">Contact</a>
        <a href="{{ route('posts.index') }}" id="size">Blog Posts</a>
        <a href="{{ route('posts.create') }}" id="size">Add</a>
        @guest
            @if (Route::has('register'))
                <a class="p-2 text-dark" href="{{ route('register') }}" id="size">Register</a>
            @endif
            <a class="p-2 text-dark" href="{{ route('login') }}" id="size">Login</a>
        @else
            <a class="p-2 text-dark" id="size" href="{{ route('logout') }}"
                onclick="event.preventDefault();document.querySelector('#logout-form').submit();" id="unique"
                style="font-size: 1.7rem;">Logout
                ({{ Auth::user()->name }})</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="visibility: hidden;">
                @csrf</form>
        @endguest
    </div>
    <div class="overlay"></div>
    <div class="GoToTop" href="#body"><i class="fa-solid fa-circle-arrow-up fa-2xl"></i></div>
    <div class="container mt-7">
        @if (session('status'))
            <div class="alert alert-success" style="z-index: 1; margin-top: 1.8rem;">
                <li>{{ session('status') }}</li>
            </div>
        @endif
        <div class="mt-4">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('/stylization/script.js') }}" rel="stylesheet"></script>
    <script>
        ScrollReveal({
            reset: false,
            distance: '30px',
            duration: 2000,
            delay: 200
        });

        ScrollReveal().reveal('#reveal');
    </script>

    <script>
        $(".GoToTop").on("click", function(e) {
            // 1
            e.preventDefault();
            // 3
            $("html, body").animate({
                scrollTop: $("html").offset().top
            }, 800);
        });
    </script>
</body>

</html>
