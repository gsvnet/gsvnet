@section('content')
    <div class="container" role="main">
        <a href="{{ URL::action('Admin\AlbumController@index') }}">Terug naar albums</a>
        <h1>{{ $album->name }}</h1>
        <a href="{{ URL::action('Admin\AlbumController@edit', $album->id) }}" alt="Bewerk {{ $album->name }}">
            Album informatie bewerken
        </a>
        <p class="delta">
            {{{ $album->description }}}
        </p>

        <section class='create-album panel panel-default panel-info'>
            <div class="panel-heading add-item">
                <h4 class="panel-title">Foto toevoegen <span class="caret"></span></h4>
            </div>

            {{
                Former::open_for_files()
                    ->action(action('Admin\PhotoController@store', $album->id))
                    ->method('POST')
                    ->class('panel-body add-form')
            }}

                @include('admin.photos._form')

                <button type='submit' class='btn btn-success'>
                    <i class="fa fa-check"></i> Toevoegen
                </button>

            {{
                Former::close()
            }}

        </section>


        <ul>
            @foreach($photos as $photo)
                <li>
                    {{{ $photo->name }}}

                    <a href="{{ URL::action('Admin\PhotoController@edit', [$album->id, $photo->id]) }}" alt="Bewerk {{ $photo->name }}">
                        Bewerk foto
                    </a>
                </li>
            @endforeach

        </ul>

        {{ $photos->links() }}
    </div>
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/fotos.js"></script>
@stop