@extends('layout.app')

@section('title', 'home.index')


@section('content')
    <h1 class="m-4">This is home.index</h1>
    
    @can('hello_mohamad')
    <a href="{{ route('secret') }}">admin page</a>
        <span>hello you are the admin</span>
    @endcan
@endsection
