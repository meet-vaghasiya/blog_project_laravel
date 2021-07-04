<p class="text-muted">

    {{ empty(trim($slot)) ? 'Added ' : '' }} {{ $date->diffForHumans() }}
    @if (!empty($name))
        by
        {{ $name }}
    @endif


</p>
