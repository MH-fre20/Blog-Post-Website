@extends('layouts.app')

@section('content')

@forelse ($posts as $post)
    @include('posts.partials.post')
@empty
    No posts Found!!!
@endforelse
@endsection


