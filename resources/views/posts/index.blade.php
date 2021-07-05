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
                    @updated(['date'=>$post->created_at,'name'=>$post->user->name])
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
                <div class="row mb-3">
                    {{-- <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most commented post</h5>

                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($most_commented as $post)

                                <a class="list-group-item" href="{{ route('posts.show', ['post' => $post->id]) }}">
                                    {{ $post->title }}
                                </a>
                            @endforeach
                        </ul>

                    </div> --}}


                    @cards(['title'=>'Most commented post'])
                    @slot('items')
                        @foreach ($most_commented as $post)

                            <a class="list-group-item" href="{{ route('posts.show', ['post' => $post->id]) }}">
                                {{ $post->title }}
                            </a>
                        @endforeach
                    @endslot
                    @endcards


                </div>
                <div class="row mb-3">
                    {{-- <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Most active user</h5>

                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($most_active_user as $user)

                                <p class="list-group-item">
                                    {{ $user->name }}({{ $user->posts_count }})</p>
                            @endforeach
                        </ul>

                    </div> --}}

                    @cards(['title'=>'Most active user'])
                    @slot('items', collect($most_active_user)->pluck('name'))
                        @endcards

                    </div>
                    <div class="row mb-3">
                        {{-- <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Most active user last month</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                    the
                                    card's content.</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach ($most_active_user_last_month as $user)

                                    <p class="list-group-item">{{ $user->name }} ({{ $user->posts_count }})</>
                                @endforeach
                            </ul>

                        </div> --}}
                        @cards(['title'=>'Most active user last month'])
                        @slot('items', collect($most_active_user_last_month)->pluck('name'))
                            @endcards

                        </div>
                    </div>
                </div>
            </div>

        @endsection
