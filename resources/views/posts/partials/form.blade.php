<div class="mb-3 row">
    <label for="title" class="col-sm-2 col-form-label">Title: </label>
    <input type="text" id="title" name="title" value="{{ old('title', optional($post ?? null)->title) }}" class="form-control">
</div>
{{-- @error('title')
    <li>{{ $message }}</li>
@enderror --}}

<div class="mb-3 row">
    <label for="content" class="col-sm-2 col-form-label">Content: </label>
    <textarea name="content" id="content" class="form-control">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>

<div class="mb-3 row">
    <label for="thumbnail">Thumbnail: </label>
    <input type="file" id="title" name="thumbnail" class="form-control">
</div>

@if ($errors->any())
    <div class="mb-3">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li
                class="list-group-item list-group-item-danger">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif