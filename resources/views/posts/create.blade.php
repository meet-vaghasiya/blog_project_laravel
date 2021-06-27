@extends('layouts.app')

@section('title', 'Create post')


@section('content')

    @if (session('status'))
        <div class="">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        @include('posts.partials.form')

    </form>

@endsection
