@extends('layout.app')

@section('title', 'home.index')


@section('content')
    <div class="pt-4">
        <h1>This is home.index</h1>
        @can('hello_mohamad')
            <a href="{{ route('secret') }}">admin page</a>
            <span>hello you are the admin</span>
        @endcan
    </div>
@endsection
