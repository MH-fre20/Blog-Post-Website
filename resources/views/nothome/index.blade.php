@extends('layout.app')

@section('title', 'home.index')

<style>
    .swiper {
        height: 600px;
        width: 100%;
    }

    #image {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        font-size: 2rem;
        padding-top: 2rem; 
        color: white;
        text-shadow: 2px 2px 3px black;
        -webkit-text-stroke: 1px black; 
    }

    #changeColor {
        color: bisque;
    }
</style>

@section('content')
    <div class="pt-4">
        <h1 style="text-align: center;">The Latest 5 Blog Post Title of yours</h1>
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="container swiper-wrapper">
                <!-- Slides -->
                @forelse ($user as $item)
                    <div class="swiper-slide" id="image"
                        style="background: url('{{ $item->Image ? asset('/storage/' . $item->Image->path) : asset('stylization/download.png') }}');
                        min-height: 500px;
            min-width: 300px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center; 
            text-align: center">
                        {{ $item->title }}</div>
                @empty
                    <div class="swiper-slide" id="image"> you have no image yet!!!</div>
                @endforelse
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination">
            </div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev" id="changeColor"></div>
            <div class="swiper-button-next" id="changeColor"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
        @can('hello_mohamad')
            <a href="{{ route('secret') }}">admin page</a>
            <span>hello you are the admin</span>
        @endcan
    </div>
@endsection
