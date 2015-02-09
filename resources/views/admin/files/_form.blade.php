{{ Former::text('name')->required()->autofocus()->label('Titel')->help('Vul iets moois in; het hoeft niet per se xxx_laatste_versie.docx te zijn') }}

{{ Former::file('file')->label('Kies een bestand')->help("Als het goed is kun je aardig grote bestanden ook uploaden") }}

@if ($labels->count() > 0)
    <label>Kies geschikte labels</label>
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
@if (Permission::has('docs.publish'))
    {{ Former::checkbox('published')->text('Publiceer bestand')->label('Publiceren?')->help('Aanvinken betekent dat het zichtbaar is op de site')->value('1') }}
@else
    <p class="bg-warning">Belangrijk: jij, als individu, kan niet bestanden direct publiceren, vanwege bepaalde redenen. Iemand (webcie/senaat/anders) die daar rechten voor heeft, zal dit zo snel mogelijk doen als jij dit formuliertje hebt verstuurd.</p>
@endif

<hr>