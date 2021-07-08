@auth



    <form action="{{ route('post.comment.store', ['post' => $post->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content"></label>
            <textarea name="content" id="content" class="form-control" type="text"></textarea>

        </div>
        <button type="submit" class="btn btn-primary btn-block"> Add Comment </button>

    </form>
    @errors @enderrors
@else
    <a href="{{ route('login') }}">Sign in</a> to post comment

@endauth
<hr />
