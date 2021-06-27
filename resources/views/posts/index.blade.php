@extends('layouts.app')

@section('title', 'posts')


@section('content')
    @foreach ($posts as $key => $post)
        @if ($loop->even)

            {{ $key }}->{{ $post->title }}
        @else
            {{ $key }}--->{{ $post->title }}

        @endif
        <br>
        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="DELETE">
        </form>
        <br>
    @endforeach
@endsection
