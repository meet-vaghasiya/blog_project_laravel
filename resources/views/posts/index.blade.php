@extends('layouts.app')

@section('title', 'posts')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">

                @foreach ($posts as $key => $post)
                    {{-- @if ($loop->even)

            {{ $key }}->{{ $post->title }}
        @else
            {{ $key }}--->{{ $post->title }}

        @endif --}}

                    <h3>

                        @if ($post->trashed())
                            <del>
                        @endif

                        <a class="{{ $post->trashed() ? 'text-muted' : '' }}"
                            href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>

                        @if ($post->trashed())
                            </del>
                        @endif

                    </h3>
                    @updated(['date'=>$post->created_at,'name'=>$post->user->name,'userId'=>$post->user->id])
                    @endupdated
                    @tags(['tags'=>$post->tags])

                    @endtags


                    @if ($post->comments_count)
                        <p>{{ $post->comments_count }} comments</p>
                    @else
                        No comments Yet!!
                    @endif
                    <div class="mb-3">


                        @auth

                            @can('update', $post)
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
                            @endcan
                        @endauth

                        @auth

                            @if (!$post->trashed())

                                @can('delete', $post)

                                    <form class="d-inline" action="{{ route('posts.destroy', ['id' => $post->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="DELETE" class="btn btn-primary">
                                    </form>
                                @endcan
                            @endif
                        @endauth

                    </div>
                @endforeach
            </div>
            <div class="col-4">
                @include('posts.partials._activity')
            </div>

        @endsection
