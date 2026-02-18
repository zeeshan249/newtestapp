@props([
    'sortable' => false,
    'direction' => null,
    'title' => null,
    'width' => '100%',
])
<th class="table-sortable" {{ $attributes }}> 
    {{ $slot }}
       @if ($sortable)
            @if ($direction === 'asc')
                <span>▲</span>
            @elseif ($direction === 'desc')
                <span>▼</span>
            @else
                <span>⇅</span>
            @endif
        @endif
</th>