@section('content')
<div class="column-holder" role="main">
    <h2>Album bewerken</h2>

    {{
        Former::vertical_open()
            ->action(action('Admin\AlbumController@update', $album->id))
            ->rules(Model\Album::$rules)
            ->method('PUT')
    }}
        {{ Former::populate( $album ) }}

        @include('admin.albums._form')

        <button type='submit' class='btn btn-success'>
            <i class="fa fa-check"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
    {{
        Former::close()
    }}

    <hr>

    <p>Of verwijder het album.</p>

    {{
        Former::inline_open()
          ->action(action('Admin\AlbumController@destroy', $album->id))
          ->method('DELETE')
    }}
        <button type='submit' class='btn btn-danger'>
            <i class="fa fa-trash"></i> Verwijderen
        </button>

    {{
        Former::close();
    }}
</div>
@stop

@section('javascripts')
    @parent

    <script>
    $('.btn-danger').click( function() {
        return confirm('Zeker weten?');
    });
    </script>
@stop