<section class="create-event">
    <h2><i class="fa fa-plus"></i> Activiteit toevoegen</h2>

    {!! Former::vertical_open()
        ->action(action('Admin\EventController@store'))
        ->method('POST') !!}

    @include('admin.events._form')

    <button type='submit' class='btn btn-success'>
        <i class="fa fa-check"></i> Toevoegen
    </button>

    {!! Former::close() !!}
</section>