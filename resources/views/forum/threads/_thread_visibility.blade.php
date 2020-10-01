@if(Gate::allows('threads.show-internal') and Gate::denies('threads.show-private'))
    @if($visibility == 'public')
        <div>
            {!! Former::checkbox('visibility')
                ->value('public')
                ->text('Maak topic zichtbaar voor externen')
                ->label('Publiek?')
                ->check() !!}
        </div>
    @else
        <div>
            {!! Former::checkbox('visibility')
                ->value('public')
                ->text('Maak topic zichtbaar voor externen')
                ->label('Publiek?') !!}
        </div>
    @endif
@elseif(Gate::allows('threads.show-private'))
    <div>
        {!! Former::radios('Toegang')
            ->radios([
                'Privé - alleen toegankelijk voor leden' => ['name' => 'visibility', 'value' => 'private'],
                'Intern - tevens toegankelijk voor reünisten' => ['name' => 'visibility', 'value' => 'internal'],
                'Publiek - toegankelijk voor iedereen' => ['name' => 'visibility', 'value' => 'public']
            ])
            ->check($visibility) !!}
    </div>
@endif