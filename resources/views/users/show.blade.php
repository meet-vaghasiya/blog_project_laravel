@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <img src="{{ $user->image ? $user->image->url() : '' }}" alt="profile image" class="img-thumbnail avatar">

        </div>
        <div class="col-md-8">

            <h3>{{ $user->name }}</h3>

            @commentForm(['route'=>route('users.comments.store', ['user' => $user->id])])
            @endcommentForm
            @commentList(['comments'=>$user->commentsOn])

            @endcommentList
        </div>


    </div>


@endsection
