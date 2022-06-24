@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-8">
            @if (isset($tag))
                @forelse ($tag as $post)
                    @include('posts.partials.post')
                @empty
                    No posts Found!!!
                @endforelse
            @else
                @forelse ($posts as $post)
                    @include('posts.partials.post')
                @empty
                    No posts Found!!!
                @endforelse
            @endif
        </div>
        <div class="col-4 mt-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <p class="card-text text-primary">What people are currently talking
                                about
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($MostCommented as $post)
                                <li class="list-group-item" id="mostCommented">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <br></br>
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <p class="card-text text-primary">Users with Most
                                posts written
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($MostActive as $post)
                                <li class="list-group-item" id="mostCommented">
                                    {{ $post->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
