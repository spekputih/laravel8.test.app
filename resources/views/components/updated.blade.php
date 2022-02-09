{{ trim($slot) ? $slot :'Added ' }} {{ $date->diffForHumans() }}  
@if (isset($name))
    by {{$name}}
@endif