<section class='create-album'>
    <h2><i class="fa fa-plus"></i> Album toevoegen</h2>

    {!! Former::vertical_open()
        ->action(action('Admin\AlbumController@store'))
        ->method('POST')
        ->class('add-form')!!}

        @include('admin.albums._form')

        <button type='submit' class='btn btn-success'>
            <i class="fa fa-check"></i> Toevoegen
        </button>

    {!! Former::close() !!}
</section>