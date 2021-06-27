@extends('layouts.app')

@section('title', 'posts')


@section('content')

    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</h3>
    <p>{{ $post->created_at->diffForHumans() }}</h3>

        {{-- {{ dd('sdf') }} --}}
        @if (now()->diffInMinutes($post->created_at) < 5)
            <div class="alert alert-info">New!!</div>

        @endif

    @endsection
