@extends('layout.app')

@section('content')
        <div class="row">
            <div class="col-4 mt-3">
                <img src="{{ $user->Image ? asset("/storage/".$user->Image->path) : ' ' }}" alt="" class="img-thumbnail"
                style="min-height: 4rem;">
            </div>
            <div class="col-8 mt-4">
                <h3>{{ $user->name }}</h3>
            </div>
        </div>
    </form>
@endsection
