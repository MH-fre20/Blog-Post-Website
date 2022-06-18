<style>
    h3 {
        display: flex;
        gap: 1rem;
        list-style: none;
    }

    .allpost {
        margin: 2rem;
        border: 1px solid rgb(115, 203, 232);
        border-radius: .3rem;
        transform: translate(0rem, 0rem);
        box-shadow: 0px 0px 0px 0px white;
        transition: transform .3s, box-shadow .3s;
        text-align: left;
    }

    a {
        text-decoration: none;
        text-transform: capitalize;
    }

    .allpost > * {
        margin: 1rem;
    }

    .allpost:hover {
        box-shadow:14px -14px 1px 1px lightblue;
        transform: translate(-.6rem, .6rem);
        color: lightsalmon;
    }

    .allpost:hover #title {
        color: black;
    }

    .display:nth-child(n+1) {
        display: block;
    }

    #myform > *, #myform form input{
        background-color: var(--yellow);
        color: azure !important;
    }

</style>

@section('title', 'see all posts')

<div class="allpost">
    <div id="title">
        @if ($post->trashed())
        <del>
        @endif
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="fs-4">
                {{ $post->title }}
            </a>
        @if ($post->trashed())
        </del>
        @endif
    </div>
        <p>Added at {{ $post->created_at->diffForHumans() }} By {{ $post->user->name }}</p>
        @tags(['tags' => $post->tags])@endtags

        @if ($post->comments_count)
            <p>{{ $post->comments_count }} comments</p>
        @else 
            <p>No comments yet!!!!</p>
        @endif

    <div id="myform">
        @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary my-2">
            Edit
        </a>
        @endcan
        
        @if (!$post->trashed())
        @can('delete', $post)
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-primary">
        </form>
        @endcan
        @endif
    </div>
</div>
