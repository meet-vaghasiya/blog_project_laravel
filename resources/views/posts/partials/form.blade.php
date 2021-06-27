<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title"
        value="{{ old('title', optional($post ?? null)->title) }}" placeholder="Enter title">
</div>


@error('title')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror
<div class="form-group">
    <label for="content">Content</label>
    <textarea name="content" class="form-control" id="content"
        placeholder="Enter content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
@error('content')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror
@if ($errors->any())

    <div class="mb-3">
        <ul class="list-group">
            @foreach ($errors->all() as $err)
                <li class="list-group-item list-group-item-danger"> {{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
