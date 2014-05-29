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
                    <li>
                        @if( Permission::has('users.show'))
                            <a href="{{URL::action('UserController@showUser', [$member->id])}}" title="Bekijk het profiel van {{{$member->fullName}}}" class="list-title">{{{$member->fullName}}}</a>
                        @else
                            <span class="list-title">{{{$member->fullName}}}</span>
                        @endif
                        <span class="list-description grey">{{{$member->senateFunction}}}</span>
                    </li>
                    @endforeach
                </ul>

            </div>
            <div class="content-columns content-column">
                @include('de-gsv.senates._list')
            </div>
        </div>
    </div>
@stop