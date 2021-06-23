<div style="padding-bottom: 15px">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ $side === 'left' ? $left->name : $right->name }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @foreach($entries as $entry)
            @if($side === 'left')
            @if($entry->id !== $left->id)
            <a class="dropdown-item" href="{{ route('entries.compare', ['id1' => $entry->id, 'id2' => $right->id]) }}">{{ $entry->name }}</a>
            @endif
            @else
            @if($entry->id !== $right->id)
            <a class="dropdown-item" href="{{ route('entries.compare', ['id1' => $left->id, 'id2' => $entry->id]) }}">{{ $entry->name }}</a>
            @endif
            @endif
            @endforeach
        </div>
    </div>
</div>