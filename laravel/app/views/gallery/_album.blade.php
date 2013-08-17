<div class="photo-tile {{ $first }} {{ $wide }}">
    <a href="{{ URL::route('show_media', $album->id); }}" class="photo-link" title="{{ $album->name }}">
        @if ($wide == 'wide')
            <img src="{{ $album->wideImage() }}" alt="{{ $album->name }}" />
        @else
            <img src="{{ $album->smallImage() }}" alt="{{ $album->name }}" />
        @endif
        <p class="photo-description">{{ $album->description }}</p>
    </a>
</div>