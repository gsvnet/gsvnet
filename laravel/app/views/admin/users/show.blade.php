@section('content')
    <!-- <a href="{{ URL::action('Admin\UsersController@index') }}">Terug naar gebruikers</a> -->
    <div class="page-header">
        <h1>{{{ $user->full_name }}}</h1>

    </div>

    <dl class="dl-horizontal">
        <dt>Voornaam</dt>
        <dd>{{{ $user->firstname }}}</dd>

        <dt>Achternaam</dt>
        <dd>{{{ $user->lastname }}}</dd>

        <dt>Tussenvoegsel</dt>
        <dd>{{{ $user->middlename }}}</dd>

        <dt>Email</dt>
        <dd>{{{ $user->email }}}</dd>

        <dt>Type</dt>
        <dd>{{{ $user->type }}}</dd>
    </dl>
    <a href="{{ URL::action('Admin\UsersController@edit', $user->id) }}" alt="Bewerk {{{ $user->full_name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Account bewerken
    </a>

    {{-- Show profile info if user has a profile --}}
    @if ($profile)
    <div class="page-header">
        <h2>Profiel informatie</h2>
    </div>

    <dl class="dl-horizontal">
        @foreach ($profile->toArray() as $key => $value)
            <dt>{{{ $key }}}</dt>
            <dd>{{{ $value }}}</dd>
        @endforeach
    </dl>

    <a href="{{ URL::action('Admin\UsersController@edit', $user->id) }}" alt="Bewerk {{{ $user->full_name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Profiel bewerken
    </a>
    @endif

    @if ($committees->count() > 0)
    <div class="page-header">
        <h2>Commissies</h2>
        <ul>
            @foreach ($committees as $committee)
                <li>
                    {{{ $committee->name }}}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- $users->links() --}}
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
