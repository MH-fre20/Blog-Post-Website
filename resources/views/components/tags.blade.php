<style>
    #tags:hover {
        color: wheat;
    }

    #space a{
        margin: .1rem;
    }
</style>

<div id="space">
    @foreach ($tags as $tag)
        <a id="tags" href="{{ route('posts.tags.index', ['tag' => $tag->id]) }}" class="badge bg-success" style="text-decoration: none">{{ $tag->name }}</a>
    @endforeach
</div>