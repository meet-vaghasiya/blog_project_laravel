<div><input type="text" name="title" value="{{ old('title', optional($post ?? null)->title) }}"
        placeholder="Enter title">
</div>

@error('title')
    {{ $message }}
@enderror
<div><textarea name="content" cols="30" rows="10"
        placeholder="Enter content">{{ old('content', optional($post ?? null)->content) }}</textarea>
</div>
@error('content')
    {{ $message }}
@enderror
@if ($errors->any())

    <div>
        <ul>
            @foreach ($errors->all() as $err)
                <li> {{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div><input type="submit" value="Create"></div>
