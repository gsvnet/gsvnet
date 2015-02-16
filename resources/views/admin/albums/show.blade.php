@section('content')

    <div class="page-header">
        <h1>{{{ $album->name }}}</h1>
        <p>{{{ $album->description }}}</p>
        <p>{{ $album->public ? 'Publiek album' : 'Privéalbum'}}</p>
        <p><a href="{{ URL::action('Admin\AlbumController@edit', [$album->id]) }}" class="btn btn-default" title="Bewerk album">Albuminformatie bewerken</a></p>
    </div>

    <section class="spacer row">
        <div class="col-xs-12 col-md-6">
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
                                        {{ $photo->name }}
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

            {!! $photos->render() !!}
        </div>

        <div class="col-xs-12 col-md-6">
            <h2><i class="fa fa-plus"></i> Foto's toevoegen</h2>
            <h3>Meerdere tegelijk</h3>
            {!! Former::open_vertical_for_files()
                ->action(action('Admin\PhotoController@store', $album->id))
                ->method('POST')
                ->class('dropzone')
                ->id('uploadmultiple') !!}

            {!! Former::close() !!}

            <h3>Een enkele toevoegen</h3>
            {!! Former::open_vertical_for_files()
                    ->action(action('Admin\PhotoController@store', $album->id))
                    ->method('POST') !!}

            @include('admin.photos._form')

            <button type='submit' class='btn btn-success'>
                <i class="fa fa-check"></i> Toevoegen
            </button>

            {!! Former::close() !!}
        </div>
    </section>
@stop