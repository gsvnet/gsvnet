<div class="photo-tile {{ $class }}">
    <a href="{{ $album->show_url }}" class="photo-link" title="{{ $album->name }}">
        @if ($wide)
            <img src="{{ $album->wide_image }}" alt="{{ $album->name }}" />
        @else
            <img src="{{ $album->small_image }}" alt="{{ $album->name }}" />
        @endif
        <p class="photo-description">{{ $album->description }}</p>
    </a>
</div>