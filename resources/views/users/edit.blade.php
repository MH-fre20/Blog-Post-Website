@extends('layout.app')

@section('content')
    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data"
        class="form-horizontal">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4 mt-4">
                <img src="{{ $user->Image ? asset("/storage/".$user->Image->path) : asset('stylization/download.png') }}" alt="" class="img-thumbnail rounded" 
                style="min-height: 60%; min-width: 100%;">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-8 p-3">
                <div class="form-group">
                    <label for="">Name: </label>
                    <input type="text" value="{{ old('content', optional($user ?? null)->name) }}" class="form-control" name="name">
                </div>
                @component('components.error')@endcomponent

                <div class="form-group mt-4">
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div>
        </div>
    </form>
@endsection
