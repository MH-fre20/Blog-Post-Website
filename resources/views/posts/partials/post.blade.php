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
