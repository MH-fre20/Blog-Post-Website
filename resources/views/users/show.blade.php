@extends('layout.app')

@section('content')
        <div class="row">
            <div class="col-4 mt-3">
                <img src="" alt="" class="img-thumbnail h-100 w-100">

                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" name="avatar" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-8 mt-4">
                <h3>{{ $user->name }}</h3>
            </div>
        </div>
    </form>
@endsection
