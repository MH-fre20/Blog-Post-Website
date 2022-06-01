<style>
    h3 {
        display: flex;
        gap: 1rem;
        list-style: none;
    }

    .allpost {
        margin: 2rem;
        box-shadow:0px 1px 1px gray;
    }

    a {
        text-decoration: none;
        text-transform: capitalize;
    }
</style>

<div class="allpost">
    <h3>
        <li>{{ $loop->iteration }}</li>
        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
            {{ $post->title }}
        </a>
    </h3>
    <div id="myform">
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary my-2">
            Edit
        </a>
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete" class="btn btn-primary">
        </form>
    </div>
</div>
