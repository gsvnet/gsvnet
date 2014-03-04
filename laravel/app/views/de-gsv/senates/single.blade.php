@section('content')

    <div class="column-holder">
        <h1>{{{$currentSenate->nameWithYear}}}</h1>
        <div class="main-content has-border-bottom" role="main">
            {{{$currentSenate->body}}}
        </div>

        <div class="secondary-column">
            <div class="content-columns content-column">
                <h2>Leden</h2>
                <ul class="unstyled-list small-event-list">
                    @foreach($currentSenate->members as $member)
                    <li>{{{$member->full_name}}} ({{{$member->pivot->function}}})</li>
                    @endforeach
                </ul>
                
            </div>
            <div class="content-columns content-column">
                <h2><a href="{{ URL::action('AboutController@showSenates') }}" title="Alle senaten">Senaten</a></h2>
                <div id="senates">
                    @if(count($senates) > 0)
                    <ul id="senates-list" class="list secondary-menu to-select-box">
                        @foreach($senates as $senate)
                            <li class="senate"><a href="{{{URL::action('AboutController@showSenate', array($senate->id))}}}">{{{$senate->nameWithYear}}}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop