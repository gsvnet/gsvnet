@section('content')
    <h1>Administratie</h1>

    <p class="lead">Hallo</p>


    <h3>Jaarverbanden</h3>
    <ul class="list-unstyled">
        @foreach($year_groups as $yeargroup)
        <li>
            {{{ $yeargroup->name }}} ({{{ $yeargroup->year }}})
        </li>
        @endforeach
    </ul>
    TODO: jaarverbanden bewerken, toevoegen en verwijderen
@stop
