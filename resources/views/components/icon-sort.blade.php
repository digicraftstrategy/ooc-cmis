@props(['direction' => 'asc'])

<span>
    @if($direction === 'asc')
        ↑
    @else
        ↓
    @endif
</span>
