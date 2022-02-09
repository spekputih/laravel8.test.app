<div class="card {{ $style }}">
    <div class="card-body">
        <h4 class="card-title">{{ $title }}</h4>
        <p class="card-subtitle text-muted">{{ trim($subtitle) ? $subtitle: ' ' }} </p>
        <hr>               
        {{ $list }}
        {{-- <ul class="list-group list-group-flush">
            @if(is_a($items, 'Illuminate\Support\Collection'))
                @foreach ($items as $item)
                    <li class="list-group-item">
                        {{ $item }}
                    </li>
                @endforeach
            @else
                {{ $items }}
            @endif
        </ul> --}}
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>