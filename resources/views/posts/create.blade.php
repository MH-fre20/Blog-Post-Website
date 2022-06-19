@extends('layout.app')
@section('title', 'Create the post')
    
@section('content')
    <form action="{{ route('posts.store') }}" method="POST" id="mydesignform" enctype="multipart/form-data">
        @csrf
        @include('posts.partials.form')
        <div class="mt-4 row">
            <input type="submit" value="Create" class="btn btn-primary btn-block form-control">
        </div>
    </form>
@endsection