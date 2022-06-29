<div class="mt-4">
    @auth
        <form action="{{ $route }}" method="POST" id="mydesignform">
            @csrf
            <div class="mb-3 row form-group">
                <textarea type="text" id="title" name="content" class="form-control"></textarea>
            </div>
            <div class="mt-4 row">
                <input type="submit" value="Add Comment" class="btn btn-primary btn-block form-control">
            </div>
        </form>
    @else
        <a href="{{ route('login') }}" style="text-decoration: none;">Sign-in if you
            want to write comment</a>
    @endauth
</div>
<hr>
