@extends('layout.app')
@section('title', 'Update the post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data" class="m-4">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div class="row mt-4">
            <input type="submit" value="Update" class="btn btn-primary btn-block form-control">
        </div>
    </form>
@endsection