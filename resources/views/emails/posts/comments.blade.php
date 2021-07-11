<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

</style>

<p> Hi {{ $comment->user->name }}</p>

<p>
    Someone is comment on yout post
    <a
        href="{{ route('posts.show', ['post' => $comment->commentable->id]) }}">{{ $comment->commentable->title }}</a>
</p>

<p>

    <img src="{{ $message->embed($comment->user->image->url()) }}" alt="mail image">
    before image
    <a href="{{ route('users.show', ['user' => $comment->user->id]) }}">{{ $comment->user->name }}</a> said
    @auth
    <p>{{ $comment->content }}</p>
@endauth
</p>
