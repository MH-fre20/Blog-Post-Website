@extends('layouts.app')
@section('title', 'Create the post')
    
@section('content')
    <form action="{{ route('posts.store') }}" method="POST" id="mydesignform">
        @csrf
        @include('posts.partials.form')
        <div>
            <input type="submit" value="Create" class="btn btn-primary btn-block form-control">
        </div>
    </form>
@endsection