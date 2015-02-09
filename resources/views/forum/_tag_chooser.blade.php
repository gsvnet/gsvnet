<div class="row">
    @if($tags->count() > 0)
        <h3>Tags</h3>
        <p>Beschrijf je onderwerp door maximaal drie tags aan te klikken</p>
        {{ $errors->first('tags', '<p class="help-block">:message</p>') }}
        <ul class="tags-select-list tags _tag_list">
            @foreach($tags as $tag)
                <li>
                    <a href="#" class="tag _tag" title="{{ $tag->slug }}">{{ $tag->name }}</a>
                </li>
            @endforeach
        </ul>
        <div class="_tag_description_container">
            <strong>Het topic is dus ongeveer zo te beschrijven:</strong>
            <ul class="_tag_descriptions">
            </ul>
        </div>
        <div style="display:none;" class="_tags">
            @foreach($tags as $tag)
                <div class="_tag" title="{{ $tag->slug }}">
                    {{ Form::checkbox("tags[{$tag->id}]", $tag->id, isset($comment) ? $comment->hasTag($tag->id) : null, ['title' => $tag->slug]) }}
                    <span class="_name">{{ $tag->name }}</span>
                    <span class="_description">{{ $tag->description }}</span>
                </div>
            @endforeach
        </div>
    @endif
</div>