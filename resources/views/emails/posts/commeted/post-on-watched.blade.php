@component('mail::message')
    # Commeet was postee on yout blog post you are watching

    Hi {{ $user->name }}

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
        View Blog post
@endcomponent


@component('mail::button', ['url' => route('users.show', ['user' => $comment->user->id])])
    View {{ $comment->user->name }}
@endcomponent


@component('mail::panel')
    {{ $comment->content }}
@endcomponent


    Thanks,<br>

    {{ config('app.name') }}
@endcomponent
