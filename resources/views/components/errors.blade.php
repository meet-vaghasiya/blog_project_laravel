@if ($errors->any())

    <div class="mb-2">
        <ul class="list-group">
            @foreach ($errors->all() as $err)
                <li class="list-group-item list-group-item-danger"> {{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
