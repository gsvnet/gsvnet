{{ Former::text('name')->required()->autofocus() }}

{{ Former::file('file')->help("") }}

@if (Permission::has('docs.publish'))
    {{ Former::checkbox('published')->text('Publiceer bestand')->label(null) }}
@endif

@if ($labels->count() > 0)
    <h3>Labels</h3>
    @foreach ($labels as $label)
        <div class="checkbox">
          <label>
            <input type="checkbox" value="{{{ $label->id }}}" name="labels[{{{ $label->id }}}]" {{ $checked[$label->id] }}>
            {{{ $label->name }}}
          </label>
        </div>
    @endforeach
@endif

<hr>
