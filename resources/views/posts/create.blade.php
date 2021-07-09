@extends('layouts.app')

@section('title', 'Create post')


@section('content')

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('posts.partials.form')
        <div><input type="submit" class="btn btn-primary btn-block" value="Create"></div>

    </form>

@endsection
