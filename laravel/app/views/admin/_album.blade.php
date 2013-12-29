<div class="photo-tile {{ $first }} {{ $wide }}">
    <a href="{{ $album->show_url }}" class="photo-link" title="{{ $album->name }}">
        @if ($wide == 'wide')
            <img src="{{ $album->wide_image }}" alt="{{ $album->name }}" />
        @else
            <img src="{{ $album->smal_iImage }}" alt="{{ $album->name }}" />
        @endif
        <p class="photo-description">{{ $album->description }}</p>
    </a>
</div>