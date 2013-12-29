@section('content')
    <!-- <a href="{{ URL::action('Admin\AlbumController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
        <h1>{{{ $photo->name }}} <small>uit <a href="{{ URL::action('Admin\AlbumController@show', $photo->album_id) }}" alt="Bewerk {{{ $photo->album->name }}}">{{{ $photo->album->name }}}</a></small></h1>
    </div>

    <h2>Originele foto</h2>
    <div class="thumbnail">
        <img src="{{{ $photo->src_path }}}" alt="{{{ $photo->name }}}" style='max-width: 100%;'>

    </div>


    <h3>Kleine foto</h3>
    <div class="thumbnail">
        <img src="{{{ $photo->small_image }}}" alt="{{{ $photo->name }}}" style='max-width: 100%;'>

    </div>

    <h3>Grote foto</h3>
    <div class="thumbnail">
        <img src="{{{ $photo->wide_image }}}" alt="{{{ $photo->name }}}" style='max-width: 100%;'>

    </div>

    <div class="panel panel-default" id='edit'>

        {{
            Former::open_vertical_for_files()
                ->action(action('Admin\PhotoController@update', [$photo->album_id, $photo->id]))
                ->method('PUT')
                ->class('panel-body add-form')
        }}
            <h2>Foto bewerken</h2>

            {{ Former::populate($photo) }}

            @include('admin.photos._form')

            <button type='submit' class='btn btn-success'>
                <i class="fa fa-check"></i> Opslaan
            </button>

        {{
            Former::close()
        }}
    </div>



    <!-- <a href="{{ URL::action('Admin\PhotoController@edit', [$photo->album_id, $photo->id]) }}" alt="Bewerk {{ $photo->name }}" class="btn btn-default">
        <i class="fa fa-pencil"></i> Foto bewerken
    </a> -->


@stop

@section('javascripts')
    @parent
    <script>
        $(document).ready(function() {
            // Hide success message after 2.5 seconds
            $('.alert.alert-success').delay(2500).slideUp(500);
        });
    </script>
@stop
