@extends('layout.app')

@section('title', $post->title)
<style>
    li {
        list-style: none;
    }
</style>

@section('content')
    <div class="p-3 py-4 row">
        <div class="col px-4">
            @if ($post->Image)
            <div id="ImageOfPost" style="background: url('{{ asset("/storage/".$post->Image->path) }}'); color: white;  
            min-height: 500px;
            min-width: 300px;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center; 
            text-align: center">
                <h3 class="p-4" style="text-shadow: 3px 3px gray">This is show.index of Post id = {{ $post->id }}
                {{ $post->title }}
            </h3>
            
            </div>
            <li>{{ $post->content }}</li>
            @else
            <ul style="list-style: none">
                <h3 class="p-4"
                style="text-shadow: 3px 3px gray">This is show.index of Post id = {{ $post->id }}
                {{ $post->title }}
            </h3>
                <li>{{ $post->content }}</li>
            @endif
                
                @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])@endcomponent

                @if (now()->diffInDays($post->created_at) < 1)
                    @component('components.badge')
                        New!
                    @endcomponent
                @endif
            </ul>
            <p>currently Read by {{ $counter }} user</p>
            <div class="h5">
                @tags(['tags' => $post->tags])
                @endtags
            </div>
            <h4>Comments</h4>
            @include('comments._form')

            @forelse ($post->comments as $item)
                {{ $item->content }} @component('components.updated', ['date' => $item->created_at, 'name' => $item->user->name])@endcomponent
            @empty
                <p class="p-2 shadow-3 shadow text-blue-400">no comments yet !!!</p>
            @endforelse
        </div>

        <div class="col-4" id="theBelow">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Most Commented</h5>
                    <p class="card-text text-primary">What people are currently talking
                        about
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($MostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}" id="mostCommented">
                                {{ $post->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <br></br>
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
@endsection
