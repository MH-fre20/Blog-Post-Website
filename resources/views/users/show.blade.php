@extends('layout.app')

@section('content')
        <div class="row">
            <div class="col-4 mt-3">
                <img src="{{ $user->Image ? asset("/storage/".$user->Image->path) : asset('stylization/download.png') }}" alt="" class="img-thumbnail"
                style="min-height: 60%; min-width: 100%;">
            </div>
            <div class="col-8 mt-4">
                <h3>{{ $user->name }}</h3>
            </div>

            @commentForm(['route' => route('users.comments.store', ['user' => $user->id])])
            @endcommentForm

            @commentList(['comments' => $user->commentOn])
            @endcommentList
        </div>
    </form>
@endsection
