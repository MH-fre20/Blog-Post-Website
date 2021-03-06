<p>
    {{-- if slot is not set we show Added --}}
    {{ empty(trim($slot)) ? 'Added ' : $slot}} {{ $date->diffForHumans() }} 
    @if (isset($name))
        @if (isset($userId))
            By <a href="{{ route('users.show', ['user' => $userId]) }}">{{ $name }}</a>
        @else
            By {{ $name }} 
        @endif
    @endif
</p>