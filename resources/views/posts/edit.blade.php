@extends('layouts.app')

@section('title', $post->title)


@section('content')
    <h1>Edit page</h1>
    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('posts.partials.form')
        <div><input type="submit" class="btn btn-primary" value="Edit"></div>

    </form>

@endsection
