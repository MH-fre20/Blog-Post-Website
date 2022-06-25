<p>
    {{-- if slot is not set we show Added --}}
    {{ empty(trim($slot)) ? 'Added ' : $slot}} {{ $date->diffForHumans() }} 
    @if (isset($name))
        By {{ $name }}
    @endif
</p>