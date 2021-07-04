@extends('layouts.app')

@section('title', 'posts')


@section('content')

    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>
    <p>{{ $post->created_at->diffForHumans() }}</p>

    {{-- {{ dd('sdf') }} --}}
    @if (now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New!!</div>

    @endif
    <h6> Comments: </h6>
    @forelse ($post->comments as $comment)
        <p>{{ $comment->content }}
            <span> ({{ $comment->created_at->diffForHumans() }})
            </span>
        </p>
    @empty
        <p> No comments found </p>
    @endforelse


@endsection
