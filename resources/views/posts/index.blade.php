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
        <div class="mb-3"><a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>

            <form class="d-inline" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="DELETE" class="btn btn-primary">
            </form>
        </div>
    @endforeach
@endsection
