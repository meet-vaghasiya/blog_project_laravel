@extends('layouts.app')

@section('title', 'Create post')


@section('content')
    <h1>edit page</h1>
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @include('posts.partials.form')

    </form>

@endsection
