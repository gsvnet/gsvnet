@section('content')
    <!-- <a href="{{ URL::action('Admin\AlbumController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $album->name }}}</h1>

    </div>

    <section class="spacer">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="active"><a href="#album-informatie" data-toggle="tab">Albuminformatie</a></li>
          <li><a href="#huidige-fotos" data-toggle="tab">Huidige foto's</a></li>
          <li><a href="#fotos-toevoegen" data-toggle="tab">Foto's toevoegen</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="album-informatie">
                <h2>Algemene informatie</h2>
                <dl class="dl-horizontal">
                  <dt>Naam</dt>
                  <dd>{{{ $album->name }}}</dd>
                  <dt>Beschrijving</dt>
                  <dd>{{{ $album->description }}}</dd>
                  <dt>Publiek?</dt>
                  <dd>{{ $album->public ? 'Ja' : 'Nee'}}</dd>
                </dl>
                <a href="{{ URL::action('Admin\AlbumController@edit', $album->id) }}" alt="Bewerk {{{ $album->name }}}" class='btn btn-default'>
                    <i class="fa fa-pencil"></i> Album informatie bewerken
                </a>
            </div>
            <div class="tab-pane" id="huidige-fotos">
                <section class="photos">
                    @foreach(array_chunk($photos->getCollection()->all(), 3) as $row)
                        <div class="row">
                           @foreach($row as $photo)
                            <div class="col-xs-4 col-md-4">

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <a href="{{ URL::action('Admin\PhotoController@show', [$album->id, $photo->id]) }}" alt="{{{ $photo->name }}}">
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
              
            </div>
            <div class="tab-pane" id="fotos-toevoegen">
                <h3>Meerdere tegelijk toevoegen</h3>

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

                <h3>Een enkele toevoegen</h3>
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
                  
            </div>
        </div>
    </section>
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
