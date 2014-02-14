@section('content')
    <h2>Commissie bewerken</h2>

    {{
        Former::vertical_open()
            ->action(action('Admin\CommitteeController@update', $committee->id))
            ->method('PUT')
    }}
        {{ Former::populate( $committee ) }}

        @include('admin.committees._form')

        <button type='submit' class='btn btn-success'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
    {{
        Former::close()
    }}

    <h3>Leden toevoegen</h3>
    <ul class='list-group'>
        @foreach($users as $user)
            @include('admin.committees._member')
        @endforeach
    </ul>

    <hr>

    <p>Of verwijder de commissies.</p>

    {{
        Former::inline_open()
          ->action(action('Admin\CommitteeController@destroy', $committee->id))
          ->method('DELETE')
    }}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen
        </button>

    {{
        Former::close();
    }}
@stop

@section('javascripts')
    @parent

    <script>
    $('.btn-danger').click( function() {
        return confirm('Zeker weten?');
    });
    </script>
@stop