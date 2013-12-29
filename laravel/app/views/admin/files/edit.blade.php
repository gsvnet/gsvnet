@section('content')
    <h2>Bestand bewerken</h2>

    {{
        Former::open_vertical_for_files()
            ->action(action('Admin\FilesController@update', $file->id))
            ->rules(Model\File::$rules)
            ->method('PUT')
    }}
        {{ Former::populate( $file ) }}

        @include('admin.files._form')

        <button type='submit' class='btn btn-success'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
    {{
        Former::close()
    }}

    <hr>

    <p>Of verwijder het bestand.</p>

    {{
        Former::inline_open()
          ->action(action('Admin\FilesController@destroy', $file->id))
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