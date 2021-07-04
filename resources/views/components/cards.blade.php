<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>

    </div>
    <ul class="list-group list-group-flush">
        @if (is_a($items, 'Illuminate\Support\Collection'))
            @foreach ($items as $key => $item)
                <li class="list-group-item">
                    {{ $item }}


                </li>

                {{-- <p class="list-group-item">
                {{ $user->name }}({{ $user->posts_count }})</p> --}}
            @endforeach
        @else
            {{ $items }}
        @endif

    </ul>

</div>
