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
