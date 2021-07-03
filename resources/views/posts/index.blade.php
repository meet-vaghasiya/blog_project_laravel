@extends('layouts.app')

@section('title', 'posts')


@section('content')
    @foreach ($posts as $key => $post)
        {{-- @if ($loop->even)

            {{ $key }}->{{ $post->title }}
        @else
            {{ $key }}--->{{ $post->title }}

        @endif --}}

        <h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
        </h3>
        <p> Added at {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }} </p>

        @if ($post->comments_count)
            <p>{{ $post->comments_count }}</p>
        @else
            No comments Yet!!
        @endif
        <div class="mb-3">

            @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
            @endcan

            @can('delete', $post)

                <form class="d-inline" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="DELETE" class="btn btn-primary">


                </form>
            @endcan
        </div>
    @endforeach
@endsection
