@if ($errors->any())
    <div class="mb-3 mt-3">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item list-group-item-danger m-1">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif