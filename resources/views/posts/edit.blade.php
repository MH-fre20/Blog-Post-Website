@extends('layout.app')
@section('title', 'Update the post')

@section('content')
    <form id="fomola" action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data" class="m-3">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div class="row mt-4">
            <input type="submit" value="Update" class="btn btn-primary btn-block form-control">
        </div>
    </form>
@endsection