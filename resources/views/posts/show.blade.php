@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="p-3 py-4">
        <h3>This is show.index of Post id = {{ $post->id }}</h3>
        <ul style="list-style: none">
            <li>{{ $post->title }}</li>
            <li>{{ $post->content }}</li>
            <li>Added {{ $post->created_at->diffForHumans() }}</li>

            @if (now()->diffInDays($post->created_at) < 1)
                <div class="alert alert-info">New!</div>
            @endif
        </ul>
        <h4>Comments</h4>
        @forelse ($post->comments as $item)
            <p>{{ $item->content }}, added at {{ $item->created_at->diffForHumans() }}</p>
        @empty
            <p class="p-2 shadow-3 shadow text-blue-400">no comments yet !!!</p>
        @endforelse
    </div>
@endsection
