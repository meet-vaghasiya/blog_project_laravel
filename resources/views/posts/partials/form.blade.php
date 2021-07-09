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
<div class="form-group">
    <label for="thumbnail">Thumbnail</label>
    <input name="thumbnail" type="file" class="form-control" id="thumbnail" placeholder="Enter content">
</div>
@error('content')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
@enderror

@errors
@enderrors
