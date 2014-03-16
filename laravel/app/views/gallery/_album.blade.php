<div class="photo-tile {{ $class }}">
    <a href="{{ $album->show_url  }}" class="photo-link" title="{{ $album->name }}">
        @if ($wide)
            <img src="{{ $album->wide_image_url }}" alt="{{ $album->name }}" width="634" height="308" />
        @else
            <img src="{{ $album->small_image_url }}" alt="{{ $album->name }}" width="308" width="308" />
        @endif
    </a>
</div>