@section('content')
    <!-- <a href="{{ URL::action('Admin\CommitteeController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $committee->name }}}</h1>

    </div>

    <p class=''>
        {{{ $committee->description }}}
    </p>

    @if ($members->count() > 0)
    <h2>Leden</h2>
    <div class="panel panel-primary">
        <div class="panel-heading">Lid toevoegen</div>
        <div class="panel-body">
            {{
                Former::vertical_open()
                    // ->action(action('Admin\CommitteeController@addMember', $committee->id))
                    ->method('PUT')
            }}
                {{ Former::text('Lid')->placeholder('Naam lid') }}
                {{ Former::date('Begindatum')}}

                <button type='submit' class='btn btn-success btn-sm'>
                    <i class="glyphicon glyphicon-ok"></i> Opslaan
                </button>

            {{ Former::close() }}
        </div>
            <hr>

        <ul class="list-group">
            @foreach ($members as $member)
                <li class="list-group-item clearfix">
                    {{ $member->full_name }}

                    {{
                        Former::inline_open()
                          ->action(action('Admin\CommitteeController@destroy', $committee->id))
                          ->method('DELETE')
                          ->class('pull-right')
                    }}
                        <button type='submit' class='btn btn-danger btn-xs'>
                            Verwijderen
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>

                    {{
                        Former::close();
                    }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Commissie informatie bewerken
    </a>

    {{-- $users->links() --}}
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
