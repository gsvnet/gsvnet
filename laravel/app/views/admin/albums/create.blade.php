<section class='create-album panel panel-default panel-info'>
    <div class="panel-heading add-item">
        <h4 class="panel-title">Album toevoegen <span class="caret"></span></h4>
    </div>

    {{
        Former::vertical_open()
            ->action(action('Admin\AlbumController@store'))
            ->method('POST')
            ->class('panel-body add-form')
    }}

        @include('admin.albums._form')

        <button type='submit' class='btn btn-success'>
            <i class="fa fa-check"></i> Toevoegen
        </button>

    {{
        Former::close()
    }}

</section>