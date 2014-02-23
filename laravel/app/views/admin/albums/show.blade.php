@section('content')
    <!-- <a href="{{ URL::action('Admin\AlbumController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $album->name }}}</h1>

    </div>

    <p class=''>
        {{{ $album->description }}}
    </p>

    <a href="{{ URL::action('Admin\AlbumController@edit', $album->id) }}" alt="Bewerk {{{ $album->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Album informatie bewerken
    </a>

    <h2>Foto's</h2>
    <section class='create-album panel panel-default panel-info'>
        <div class="panel-heading add-item">
            <h4 class="panel-title"><i class="fa fa-plus"></i> Foto toevoegen <span class="caret"></span></h4>
        </div>

        {{
            Former::open_vertical_for_files()
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

    <section class='create-album panel panel-default panel-info'>
        <div class="panel-heading add-item">
            <h4 class="panel-title"><i class="fa fa-plus"></i> Foto's toevoegen <span class="caret"></span></h4>
        </div>
        <div class="panel-body">
            {{
                Former::open_vertical_for_files()
                    ->action(action('Admin\PhotoController@store', $album->id))
                    ->method('POST')
                    ->class('dropzone')
                    ->id('uploadmultiple')
            }}

            {{
                Former::close()
            }}
        </div>

    </section>

    <section class="photos">
        @foreach(array_chunk($photos->getCollection()->all(), 3) as $row)
            <div class="row">
               @foreach($row as $photo)
                <div class="col-xs-4 col-md-4">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a href="{{ URL::action('Admin\PhotoController@show', [$album->id, $photo->id]) }}" alt="{{{ $photo->name }}}" class="thumbnail">
                              <img src="{{ $photo->small_image_url }}" alt="{{{ $photo->name }}}">
                            </a>
                        </div>
                        <div class="panel-footer">
                            <h3 class="panel-title">
                                {{{ $photo->name }}}
                                <a href="{{ URL::action('Admin\PhotoController@show', [$album->id, $photo->id]) }}#edit" alt="Bewerk {{ $photo->name }}" class="pull-right">
                                  <i class="fa fa-pencil"></i>
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>


               @endforeach
            </div>
        @endforeach
    </section>

    {{ $photos->links() }}
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
