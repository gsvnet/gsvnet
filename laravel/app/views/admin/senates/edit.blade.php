@section('content')
    <h2>Commissie bewerken</h2>

    {{
        Former::vertical_open()
            ->action(action('Admin\SenateController@update', $committee->id))
            ->method('PUT')
    }}
        {{ Former::populate( $committee ) }}


        <button type='submit' class='btn btn-success btn-sm pull-right'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        @include('admin.committees._form')
        @include('admin.committees.members._form')

        <button type='submit' class='btn btn-success'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>

        {{
            Former::close()
        }}
    <hr>

    <p>Of verwijder de commissies.</p>

    {{
        Former::inline_open()
          ->action(action('Admin\SenateController@destroy', $committee->id))
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