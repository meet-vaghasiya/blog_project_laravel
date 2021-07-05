@extends('layouts.app')

@section('title', 'posts')


@section('content')

    <h3>{{ $post->title }}</h3>
    <div class="">Currently {{ $counter }} people is in this post</div>

    {{-- @if (now()->diffInMinutes($post->created_at) < 40)
            @badge(['show'=>false])
            New!!
            @endbadge

        @endif --}}
    @badge(['show'=>now()->diffInMinutes($post->created_at) < 40]) New!! @endbadge </h3>
        <p>{{ $post->content }}</p>


        @updated(['date'=>$post->created_at,'name'=>$post->user->name])
        @endupdated


        @updated(['date'=>$post->updated_at])
        Updated
        @endupdated
        {{-- {{ dd('sdf') }} --}}

        {{-- @component('components.badge', ['type' => 'primary'])
            New!!
        @endcomponent --}}

        @tags(['tags'=>$post->tags])

        @endtags
        <h6> Comments: </h6>
        @forelse ($post->comments as $comment)
            <p>{{ $comment->content }}
                @updated(['date'=>$comment->created_at])
                @endupdated </p>
        @empty
            <p> No comments found </p>
        @endforelse


    @endsection
