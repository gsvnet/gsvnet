@section('content')

    <div class="column-holder">
        <h1>{{{$currentSenate->nameWithYear}}}</h1>
        <div class="main-content has-border-bottom" role="main">
            {{ $currentSenate->body }}
        </div>

        <div class="secondary-column">
            <div class="content-columns content-column">
                <h2>Leden</h2>
                <ul class="unstyled-list title-description-list">
                    @foreach($members as $member)
                    <li>{{{$member->full_name}}} ({{{$member->senateFunction}}})</li>
                    @endforeach
                </ul>

            </div>
            <div class="content-columns content-column">
                @include('de-gsv.senates._list')
            </div>
        </div>
    </div>
@stop