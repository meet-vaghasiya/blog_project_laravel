@extends('layouts.app')

@section('title', 'posts')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                @if ($post->image->url())
                    <div class=""
                        style="background-image:url('{{ $post->image->url() }}');min-height:500pxtext-align:center;background-attachment:fixed">
                        <h1 class="" style="padding: 100px;text-shadow:1px 2px #000">
                        @else
                            <h1>
                @endif
                <h3>{{ $post->title }}</h3>
                <div class="">Currently {{ $counter }} people is in this post</div>
                @if ($post->image)

                    </h1>
            </div>
        @else
            </h1>
            @endif
            {{-- @if (now()->diffInMinutes($post->created_at) < 40)
            @badge(['show'=>false])
            New!!
            @endbadge

        @endif --}}
            <p>{{ $post->content }}</p>
            {{-- <img src="{{ asset($post->image->path) }}" alt="ads"> --}}
            {{-- <img src="{{ Storage::url($post->image->path) }}" alt="ads"> --}}
            {{-- <img src="{{ $post->image->url() }}" alt="ads"> --}}
            @badge(['show'=>now()->diffInMinutes($post->created_at) < 40]) New!! @endbadge </h3>


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
                @include('comments._form')
                @forelse ($post->comments as $comment)
                    <p>{{ $comment->content }}
                        {{-- @updated(['date'=>$comment->created_at])
                            @endupdated --}}
                        @updated(['date'=>$comment->created_at,'name'=>$comment->user->name])
                        @endupdated
                    </p>
                @empty
                    <p> No comments found </p>
                @endforelse

        </div>
        <div class="col-4">
            @include('posts.partials._activity');
        </div>
    </div>
    </div>
@endsection
