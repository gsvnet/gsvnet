@section('content')

    <div class="column-holder" role="main">
        <h1>{{ $committee->name }}</h1>

        <div class="main-content">
            <p>
                {{ $committee->description }}
            </p>

            <h2>Leden</h2>

            <ul class="unstyled-list title-description-list">
                @foreach ($activeMembers as $member)
                    <li>
                        <span class="list-title">{{ link_to_action('UserController@showUser', $member->full_name, [$member->id]) }}</span>
                        <span class="list-description grey">Sinds {{ $member->inCommiteeSince }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div id="committees" class="secondary-column">
            <div class="form-group">
                <label class="control-label" for="inputSearch">Zoeken</label>
                <input type="text" class="search form-control" id="inputSearch" name="inputSearch" placeholder="Zoeken">
            </div>
            <ul class="list secondary-menu">
                @foreach ($committees as $committee)
                    <li><a class="committee" href="{{ URL::action('AboutController@showCommittee', $committee->unique_name) }}">{{ $committee->name }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
@stop