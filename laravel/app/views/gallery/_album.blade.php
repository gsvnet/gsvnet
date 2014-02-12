<div class="photo-tile {{ $class }}">
    <a href="{{ $album->show_url  }}" class="photo-link" title="{{ $album->name }}">
        @if ($wide)
            <img src="{{ $album->wide_image_url }}" alt="{{ $album->name }}" />
        @else
            <img src="{{ $album->small_image_url }}" alt="{{ $album->name }}" />
        @endif
        <p class="photo-description">{{ $album->description }}</p>
    </a>
</div>