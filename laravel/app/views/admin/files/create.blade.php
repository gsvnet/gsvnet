<section class='create-album panel panel-default panel-info'>
    <div class="panel-heading add-item">
        <h4 class="panel-title">Bestand toevoegen <span class="caret"></span></h4>
    </div>

    {{
        Former::open_vertical_for_files()
            ->action(action('Admin\FilesController@store'))
            ->method('POST')
            ->rules(Model\File::$rules)
            ->class('panel-body add-form')
    }}

        @include('admin.files._form')

        <button type='submit' class='btn btn-success'>
            <i class="fa fa-check"></i> Toevoegen
        </button>

    {{
        Former::close()
    }}

</section>